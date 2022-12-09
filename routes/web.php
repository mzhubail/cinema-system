<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TimeSlotController;
use App\Models\Booking;

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

// Route::get('/', function () {
//     return view('welcome');
// });

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
Route::post('/login', [LoginController::class, 'login']);
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

Route::get('/browse_movies', [MovieController::class, 'browse']);

Route::get('/add_branch', [BranchController::class, 'show_add']);
Route::post('/add_branch', [BranchController::class, 'store']);

Route::get('/browse_branches', [BranchController::class, 'browse']);

Route::get('/', function () {
  if (session()->has('isAdmin')) {
    return session("isAdmin") ?
      view('home.admin') :
      view('home.customer');
  } else {
    return redirect('login');
  }
})
  ->name('home');

Route::any('view_session', function () {
  dd(session()->all());
});

Route::get('/logout', function () {
  session()->flush();
  return redirect('login');
});


Route::get('/add_hall', [HallController::class, 'show_add']);
Route::post('/add_hall', [HallController::class, 'store']);

Route::get('/browse_halls', [HallController::class, 'browse']);


Route::get('/add_time_slot', [TimeSlotController::class, 'show_add']);
Route::post('/add_time_slot', [TimeSlotController::class, 'store']);

Route::get('/browse_time_slots', [TimeSlotController::class, 'browse']);
Route::get('/show_time_conflicts', [TimeSlotController::class, 'show_conflicts']);


Route::get('/browse_bookings', [BookingController::class, 'browse']);
Route::get('/show_seat_conflicts', [SeatController::class, 'show_conflicts']);

// TODO: remove.  These are only intended for testing
Route::get('/add_booking', [BookingController::class, 'show_add']);
Route::post('/add_booking', [BookingController::class, 'store']);

Route::get('/browse_seats', [SeatController::class, 'browse']);
Route::get('/choose_seats', [SeatController::class, 'show_choose']);
// Route::post('/choose_seats', [SeatController::class, 'recieve_seats']);
