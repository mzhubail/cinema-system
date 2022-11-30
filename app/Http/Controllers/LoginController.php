<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\http\Request;

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

  public function login()
  {
    $request = request();

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

    $customer = Customer::select('id', 'hash')
      ->where('email', $request->email)
      ->first();

    if ($customer === null)
      die("Email doesn't exist");

    if (!password_verify(
      password: $request->password,
      hash: $customer->hash
    )) {
      die("invalid passsword");
    }

    session([
      'userId' => $customer->id,
      'isAdmin' => false,
    ]);

    return redirect('/');
  }
}
