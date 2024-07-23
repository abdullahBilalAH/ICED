<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
 /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
 public function handle(Request $request, Closure $next)
 {
  if (Auth::check() && Auth::user()->user_type == 'admin') {
   return $next($request);
  }

  return redirect()->route("dashboard");
 }
}
