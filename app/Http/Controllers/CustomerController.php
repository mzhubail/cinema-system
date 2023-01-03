<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class CustomerController extends Controller
{
  /**
   * Show registration page
   */
  public function show_register()
  {
    return view("register");
  }



  /**
   * Register a new user
   */
  public function register()
  {
    $request = request();

    Validator::make(
      data: $request->all(),
      rules: [
        'fName' => 'required|alpha|min:3|max:31',
        'lName' => 'required|alpha|min:3|max:31',
        'email' => 'required|email:rfc,dns',
        'birthday' => 'required|date_format:Y-m-d',
        'password' => [
          'required',
          Password::min(8)
            ->letters()
            ->numbers(),
          // ->mixedCase()
          // ->uncompromised()
          // ->symbols(),
          'confirmed',
        ],
      ],
      customAttributes: [
        'fName' => 'first name',
        'lName' => 'last name',
      ],
    )->validate();

    $input = $request->all();
    $input["hash"] = password_hash(
      $request->input("password"),
      PASSWORD_DEFAULT
    );

    Customer::create($input);
    session()->flash('message', 'Account created successfully');
    return redirect("login");
  }



  /**
   * Show the login page
   *
   * @return \Illuminate\View\View
   */
  public function show_login()
  {
    return view('login');
  }



  /**
   * Log the user into the system
   */
  public function login()
  {
    $request = request();
    $request->validate([
      'email' => 'required',
      'password' => 'required',
    ]);


    // Check admins
    $admin = Admin::select('id', 'hash', 'email')
      ->where('email', $request->email)
      ->first();

    if (
      $admin !== null && password_verify(
        password: $request->password,
        hash: $admin->hash
      )
    ) {
      session([
        'userId' => $admin->id,
        'isAdmin' => true,
      ]);

      return redirect('/');
    }


    // Check customers
    $customer = Customer::where('email', $request->email)->first();

    if (
      $customer !== null &&
      password_verify(
        password: $request->password,
        hash: $customer->hash
      )
    ) {
      session([
        'userId' => $customer->id,
        'customer' => $customer,
        'isAdmin' => false,
      ]);

      return redirect(session()->pull('location', '/'));
    }

    throw ValidationException::withMessages(['Invalid Email or password']);
  }


  public function show_edit()
  {
    return view('customer.edit', [
      'customer' => session('customer'),
    ]);
  }

  public function update()
  {
    $request = request();
    $customer = session('customer');

    $input = Validator::make(
      data: $request->all(),
      rules: [
        'fName' => 'required|alpha|min:3|max:31',
        'lName' => 'required|alpha|min:3|max:31',
        'email' => 'required|email:rfc,dns',
        'birthday' => 'required|date_format:Y-m-d',
      ],
      customAttributes: [
        'fName' => 'first name',
        'lName' => 'last name',
      ],
    )->validate();

    $customer->fill($input);
    $customer->save($input);

    session()->flash('message', 'Profile updated successfully');
    return back();
  }
}
