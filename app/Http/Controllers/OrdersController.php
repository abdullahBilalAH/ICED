<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
 public function __construct()
 {
  $this->middleware('admin')->except('error', 'Unauthorized action.');
 }
 public function index(Request $request)
 {
  // Determine the sort direction
  $sortDirection = $request->query('sort_direction', 'asc');

  // Fetch all orders sorted by the 'subTotal' attribute in the 'order' JSON column
  $orders = Order::orderByRaw('JSON_EXTRACT(`order`, "$.subTotal") ' . $sortDirection)->get();

  // Return view with orders data
  return view('orders.index', compact('orders'));
 }
 // app/Http/Controllers/OrdersController.php

 public function show($id)
 {
  $order = Order::findOrFail($id);

  // Extract item IDs from the order
  $itemIds = $order->order['items'] ?? [];

  // Fetch the items from the Item model
  $items = Item::whereIn('id', $itemIds)->get();

  return view('orders.show', compact('order', 'items'));
 }
}
