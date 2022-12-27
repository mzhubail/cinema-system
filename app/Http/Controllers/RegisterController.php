<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
  /**
   * Show registration page
   */
  public function show()
  {
    return view("register");
  }



  /**
   * Register a new user
   */
  public function register(Request $request)
  {
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
    return redirect("login");
  }
}
