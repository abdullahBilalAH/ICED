<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
 // Display the cart contents
 public function index()
 {
  $cart = session()->get('cart', []);

  $itemIds = array_keys($cart);
  // Retrieve the items that match the IDs in the cart
  $items = Item::whereIn('id', $itemIds)->get();
  foreach ($items as $item) {
   if (isset($cart[$item->id])) {
    $item->quantityOrder = (int) $cart[$item->id]['quantity'];
   }
  }
  return view('extension.cart_index', compact('items', 'cart'));
 }

 // Add an item to the cart
 public function add(Request $request)
 {
  // Validate the request
  $validated = $request->validate([
   'item_id' => 'required|integer|exists:items,id',
   'quantity' => 'required|integer|min:1'
  ]);

  $item = Item::find($validated['item_id']);

  // Retrieve cart from session or initialize as empty array
  $cart = session()->get('cart', []);

  // Add or update item in the cart
  if (isset($cart[$item->id])) {
   $cart[$item->id]['quantity'] += $validated['quantity'];
  } else {
   $cart[$item->id] = [
    'name' => $item->name,
    'quantity' => $validated['quantity'],
    'price' => $item->price,
   ];
  }

  // Store updated cart in session
  session()->put('cart', $cart);

  return redirect()->back()->with('success', 'Item added to cart!');
 }


 // Add item with quantity directly via route parameters (if needed)
 public function addItem($id, $quantity)
 {
  $item = Item::find($id);

  // Check if item exists
  if (!$item) {
   return redirect()->back()->with('error', 'Item not found.');
  }

  // Retrieve cart from session or initialize as empty array
  $cart = session()->get('cart', []);

  // Add or update item in the cart
  if (isset($cart[$item->id])) {
   $cart[$item->id]['quantity'] += $quantity;
  } else {
   $cart[$item->id] = [
    'name' => $item->name,
    'quantity' => $quantity,
    'price' => $item->price,
   ];
  }

  // Store updated cart in session
  session()->put('cart', $cart);

  return redirect()->back()->with('success', 'Item added to cart!');
 }

 // Clear the cart
 public function clearCart()
 {
  // Clear cart from session
  session()->forget('cart');

  return redirect()->back()->with('success', 'Cart has been cleared!');
 }

 // app/Http/Controllers/CartController.php
 public function remove(Request $request)
 {
  $itemId = $request->input('id');

  // Remove the item from the cart in the session
  $cart = session()->get('cart', []);
  if (isset($cart[$itemId])) {
   unset($cart[$itemId]);
   session()->put('cart', $cart);
  }

  return redirect()->back();
 }


 public function update(Request $request)
 {
  // Validate input
  $request->validate([
   'id' => 'required|integer|exists:items,id',
   'quantity' => 'required|integer|min:1',
  ]);

  // Get cart from session
  $cart = session()->get('cart', []);

  // Check if item exists in the cart
  if (isset($cart[$request->input('id')])) {
   // Update the quantity
   $cart[$request->input('id')]['quantity'] = $request->input('quantity');

   // Save cart back to session
   session()->put('cart', $cart);
  }

  // Redirect back to cart
  return redirect()->back()->with('success', 'Quantity updated successfully.');
 }

 public function applyCoupon(Request $request)
 {
  // Validate the request
  $request->validate([
   'code' => 'required|string|max:255',
  ]);

  // Retrieve the coupon code from the request
  $code = $request->input('code');

  // Check if the discount code exists in the database
  $discount = Discount::where('code', $code)->first();

  if ($discount) {
   // Discount code exists
   // Store the discount code and percentage in the session
   session()->put('discount_code', $discount->code);
   session()->put('discount_percent', $discount->percent);

   // Optionally set a success message
   session()->flash('success', 'Coupon applied successfully!');
  } else {
   // Discount code does not exist
   session()->flash('error', 'Invalid coupon code.');
  }

  // Redirect back to the previous page
  return redirect()->back();
 }
}
