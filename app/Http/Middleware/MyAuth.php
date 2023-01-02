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
    } elseif ($arg == 'customerLoggedIn') {
      if (session()->missing('isAdmin')) {
        session()->put('location', url()->full());
        return response()->view('login_required');
      } else if (session('isAdmin'))
        return redirect()->back();
      else
        return $next($request);
    } elseif ($arg == 'loggedIn') {
      if (session()->missing('userId')) {
        session()->put('location', url()->full());
        return response()->view('login_required');
      }

      return $next($request);
    } elseif ($arg == 'customer') {
      if (session()->missing('isAdmin') || !session('isAdmin'))
        return $next($request);
      else
        return back();
    }
  }
}
