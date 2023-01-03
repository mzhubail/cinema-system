<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TimeSlotController;
use App\Models\Booking;
use App\Models\Movie;
use App\Models\TimeSlot;

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


Route::get('/login', [CustomerController::class, 'show_login'])
  ->name("login");
Route::post('/login', [CustomerController::class, 'login']);

Route::get('/register', [CustomerController::class, 'show_register']);
Route::post('/register', [CustomerController::class, 'register']);

Route::get('/logout', function () {
  session()->flush();
  return redirect('/');
});


// Only accessible by admin
Route::middleware(['MyAuth:admin'])->group(function () {
  Route::get('/add_movie', [MovieController::class, 'show_add_movie']);
  Route::post('/add_movie', [MovieController::class, 'store']);

  Route::get('/browse_movies', [MovieController::class, 'browse']);

  Route::get('/edit_movie', [MovieController::class, 'show_edit']);
  Route::post('/edit_movie', [MovieController::class, 'update']);


  Route::get('/add_branch', [BranchController::class, 'show_add']);
  Route::post('/add_branch', [BranchController::class, 'store']);

  Route::get('/browse_branches', [BranchController::class, 'browse']);

  Route::get('/edit_branch', [BranchController::class, 'show_edit']);
  Route::post('/edit_branch', [BranchController::class, 'update']);


  Route::get('/add_hall', [HallController::class, 'show_add']);
  Route::post('/add_hall', [HallController::class, 'store']);

  Route::get('/browse_halls', [HallController::class, 'browse']);

  Route::get('/edit_hall', [HallController::class, 'show_edit']);
  Route::post('/edit_hall', [HallController::class, 'update']);


  Route::get('/add_time_slot', [TimeSlotController::class, 'show_add']);
  Route::post('/add_time_slot', [TimeSlotController::class, 'store']);

  Route::get('/browse_time_slots', [TimeSlotController::class, 'browse']);

  Route::get('/edit_time_slot', [TimeSlotController::class, 'show_edit']);
  Route::post('/edit_time_slot', [TimeSlotController::class, 'update']);

  Route::get('/show_time_conflicts', [TimeSlotController::class, 'show_conflicts']);
  Route::get('/show_seat_conflicts', [SeatController::class, 'show_conflicts']);

  Route::get('/browse_bookings_by_customer', [BookingController::class, 'browse_by_customer']);
  Route::get('/browse_bookings_by_time_slot', [BookingController::class, 'browse_by_time_slot']);


  Route::get('/browse_seats', [SeatController::class, 'browse']);


  Route::get('/sales_by_branch', [BookingController::class, 'sales_by_branch']);
});


// Only accessible by logged in customer
Route::middleware('MyAuth:customerLoggedIn')->group(function () {
  Route::get('/choose_seats', [SeatController::class, 'show_choose']);
  Route::post('/choose_seats', [SeatController::class, 'receive_chosen_seats']);

  Route::get('/confirm_booking', [BookingController::class, 'show_confirm_booking']);
  Route::post('/confirm_booking', [BookingController::class, 'confirm_booking']);

  Route::get('/edit_profile', [CustomerController::class, 'show_edit']);
  Route::post('/edit_profile', [CustomerController::class, 'update']);
});


// Accessible by any customer
Route::middleware('MyAuth:customer')->group(function () {
  Route::get('/choose_time_slot', [TimeSlotController::class, 'show_choose']);

  Route::get('/coming_soon', [MovieController::class, 'browse_coming_soon']);
  Route::get('/new_arrival', [MovieController::class, 'browse_new_arrival']);

  Route::get('/search', [MovieController::class, 'show_search']);
});


// Accessible by everyone
Route::get('/movie_details', [MovieController::class, 'show']);

Route::get('/', function () {
  return session("isAdmin", false)
    ?  view('home.admin')
    : view('home.customer', [
      'movies' => Movie::home_page_movies()->get()
    ]);
})->name('home');



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


Route::any('view_session', function () {
  dd(session()->all());
});


// TODO: remove.  These are only intended for testing
Route::get('/add_booking', [BookingController::class, 'show_add']);
Route::post('/add_booking', [BookingController::class, 'store']);


Route::get('/test', [TimeSlotController::class, 'tmp']);


Route::fallback(fn () => view('404'));
