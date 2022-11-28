<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

  public function store(Request $request)
  {
    try {
      $db = new \PDO(
        'mysql:host=localhost;dbname=tmp0;charset=utf8',
        'root',
        ''
      );
      $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

      $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
      $query = $db->prepare("SELECT hash, id FROM `users` WHERE email=?");

      $status = $query->execute([
        $_POST["email"]
      ]);
      if ($query->rowCount() === 0) {
        die("Email not found");
      }

      $row = $query->fetch();
      $hash = $row->hash;

      $flag = password_verify($_POST["password"], $hash);

      // TODO: set 'isAdmin' to indicate whether the user is an admin or customer
      if ($flag) {
        // session_start();
        // $_SESSION['userId'] = $row->id;
      }
      // TODO: Redirect to home page when users signs in
      // return view("login");
      echo $flag ? "success" : "failure";
    } catch (\PDOException $e) {
      die($e->getMessage());
    }
    // print_r($request->getContent());
    // print_r($request->query('email'));
    // dd($request->getContent());
    // dd($request->all());
    // die();
    // if ($request->collect()->isEmpty())
    //   die("no input was given");
    // print_r(Request::input("email"));
    // dd($request->only("email", "password"));
    // dd(request()->all());
    // request()->input(
    // die();
    // print_r($request == request() ? "y" : "n");
    // dd($request, request());
    // die();
    // return view("test_view")
    //   ->with("r", request());
    // return view("test_view", ["r" => request()]);
  }
}
