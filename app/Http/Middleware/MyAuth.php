<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyAuth
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, $arg)
  {
    if ($arg == 'admin') {
      if (session()->missing('isAdmin'))
        return response()->view('404');
      else if (!session('isAdmin'))
        return response()->view('404');
      else
        return $next($request);
    }

    // Require that a customer is logged in
    elseif ($arg == 'customerLoggedIn') {
      // Prompt for login if logged out
      if (session()->missing('isAdmin')) {
        session()->put('location', url()->full());
        return response()->view('login_required');
      }
      // Redirect if admin
      else if (session('isAdmin'))
        return redirect()->back();
      else
        return $next($request);
    }

    // Require that user is logged in customer or admin
    elseif ($arg == 'loggedIn') {
      // Prompt for login if logged out
      if (session()->missing('userId')) {
        session()->put('location', url()->full());
        return response()->view('login_required');
      } else
        return $next($request);
    }

    // Require that user is not admin
    elseif ($arg == 'customer') {
      if (session()->missing('isAdmin') || !session('isAdmin'))
        return $next($request);
      else
        return back();
    }
  }
}
