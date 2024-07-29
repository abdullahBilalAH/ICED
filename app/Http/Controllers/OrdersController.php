<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
 public function chart()
 {
  // Fetch the orders data
  // Fetch the number of orders for each month
  $orders = DB::table('orders')
   ->select(DB::raw('COUNT(*) as count'), DB::raw('MONTH(created_at) as month'))
   ->groupBy(DB::raw('MONTH(created_at)'))
   ->pluck('count', 'month');

  // Format data for Chart.js
  $labels = [];
  $data = [];

  for ($i = 1; $i <= 12; $i++) {
   $labels[] = Carbon::createFromDate(null, $i, 1)->format('F'); // Month name
   $data[] = $orders->get($i, 0); // Order count or 0 if no orders
  }
  $itemsOrders = [];
  $ordersData = Order::pluck('order');
  foreach ($ordersData as $or) {
   foreach ($or['items'] as $it)
    array_push($itemsOrders, $it);
  }

  // حساب تكرار كل رقم
  $counts = array_count_values($itemsOrders);

  // ترتيب التكرارات تنازلياً
  arsort($counts);

  return view('orders.chart', compact('labels', 'data'));
 }
}
