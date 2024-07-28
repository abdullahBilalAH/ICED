<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
 public function index()
 {
  // Retrieve the order from the session
  $order = session()->get('order', []);

  return view("extension.checkout", ["order" => $order]);
 }

 public function store(Request $request)
 {
  // Get the authenticated user
  $user = Auth::user();
  $userInfo  = [
   'id' => $user->id,
   'name' => $user->name
  ];
  // Get the current order from the session
  $order = session()->get('order', []);

  // Capture form data
  $address = [
   'country' => $request->input('country'),
   'streetAddress' => $request->input('streetAddress'),
   'apartment' => $request->input('apartment'),
   'city' => $request->input('city'),
   'state' => $request->input('state'),
   'postcode' => $request->input('postcode'),
   'phone' => $request->input('phone'),
   'email' => $request->input('email'),
   'orderNotes' => $request->input('orderNotes'),
  ];

  // Create a new Order instance and assign data
  $orderModel = new Order();
  $orderModel->user = $userInfo;  // Assuming $user is an Eloquent model
  $orderModel->order = $order;
  $orderModel->address = $address;

  // Save the order to the database
  $orderModel->save();
  session()->forget('order');
  session()->forget('cart');  // Assuming 'cart' is the key for cart data

  // For debugging purposes
  return redirect()->back()->with('success', 'order send!');

  // You can redirect or return a response here
  // return redirect()->route('some.route')->with('success', 'Order placed successfully!');
 }
}
