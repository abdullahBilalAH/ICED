<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
 /**
  * Display the registration view.
  */
 public function create(): View
 {
  return view('auth.register');
 }

 /**
  * Handle an incoming registration request.
  *
  * @throws \Illuminate\Validation\ValidationException
  */

 public function store(Request $request): RedirectResponse
 {
  // Validate the incoming request data
  $validatedData = $request->validate([
   'name' => ['required', 'string', 'max:255'],
   'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
   'password' => ['required', 'confirmed', 'min:8', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/'], // Example of complex password rules
  ]);

  // Create a new user instance after a valid registration
  $user = User::create([
   'name' => $validatedData['name'],
   'email' => $validatedData['email'],
   'password' => Hash::make($validatedData['password']),
  ]);

  // Fire the Registered event
  event(new Registered($user));

  // Log the user in
  Auth::login($user);

  // Redirect to the home route
  return redirect(RouteServiceProvider::HOME);
 }
}
