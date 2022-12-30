<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /**
   * Show the login page
   *
   * @return \Illuminate\View\View
   */
  public function show()
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

    foreach (config('admin_credentials') as $id => list($email, $hash)) {
      if (
        $request->email == $email &&
        password_verify($request->password, $hash)
      ) {
        session([
          'userId' => $id,
          'isAdmin' => true,
        ]);
        return redirect('/');
      }
    }

    $customer = Customer::select('id', 'hash', 'email')
      ->where('email', $request->email)
      ->first();

    if ($customer === null) {
      // session()->flash('message', ["Email doesn't exist", "error"]);
      // return redirect()->back();
      throw ValidationException::withMessages(['Invalid Email or password']);
    }

    if (!password_verify(
      password: $request->password,
      hash: $customer->hash
    )) {
      // session()->flash('message', ["Invalid password", "error"]);
      // return redirect()->back();
      throw ValidationException::withMessages(['Invalid Email or password']);
    }

    session([
      'userId' => $customer->id,
      'customer' => $customer,
      'isAdmin' => false,
    ]);

    return redirect('/');
  }
}
