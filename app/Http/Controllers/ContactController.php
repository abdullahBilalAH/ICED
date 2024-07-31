<?php

namespace App\Http\Controllers;

use App\Models\Contact_messages;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class ContactController extends Controller
{
 public function index()
 {
  return view('contact');
 }
 public function submit(Request $request)
 {
  // Validate the form data
  $validatedData = $request->validate([
   'name' => 'required|string|max:255',
   'email' => 'required|email|max:255',
   'message' => 'required|string',
  ]);

  // Save the form data to the database
  Contact_messages::create($validatedData);

  return redirect()->back()->with('success', 'Message sent successfully!');
 }
 public function show()
 {
  // Fetch all contact messages
  $messages = Contact_messages::all();

  // Pass the messages to the view
  return view('admin.contactMessages', compact('messages'));
 }
 public function subscribe(Request $request)
 {
  // Validate the request data
  $request->validate([
   'email' => 'required|email',
  ]);

  // Create a new newsletter subscription
  Newsletter::create([
   'email' => $request->input('email'),
  ]);

  // Redirect back with success message
  return redirect()->back()->with('success', 'You have successfully subscribed to the newsletter!');
 }

 public function showSubscribers()
 {
  // Fetch all subscribers
  $subscribers = Newsletter::all();

  // Pass subscribers to the view
  return view('admin.subscribers', compact('subscribers'));
 }
}
