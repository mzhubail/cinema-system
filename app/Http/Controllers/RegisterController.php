<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function show() {
    return view("register");
  }
  public function register(Request $request) {
    $input = $request->all();
    $input["hash"] = password_hash(
      $request->input("password"),
      PASSWORD_DEFAULT
    );

    Customer::create($input);
    return redirect("login");
  }
}

