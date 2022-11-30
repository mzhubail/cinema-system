<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(["get", "post"], '/test', function (Request $request) {
    // $request->session()->flush();
    $request->session()->put("name", "J");
    $x = $request->session()->get("name");
    return view(
        'test_view',
        [
            "r" => $request,
            "is_session_set" => $x,
        ]
    );
});

Route::get('/login', [LoginController::class, 'show'])
    ->name("login");
// Route::get('/login', function () { return (new LoginController())->show(); } );
Route::post('/login', [LoginController::class, 'store']);
// Route::post('/login', 'LoginController@login');
// Route::post('/login', function(Request $request) {
//     print_r($request->all());
//     die();
// });

Route::resource('customer', CustomerController::class)
    ->only(['index', 'store']);


Route::view('test_show_user_template', 'show_user');

Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/add_movie', [MovieController::class, 'show_add_movie']);
Route::post('/add_movie', [MovieController::class, 'store']);

Route::get('/movie_details', [MovieController::class, 'show']);
