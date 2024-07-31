<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ItemsController extends Controller
{
 public function __construct()
 {
  $this->middleware('admin')->except('error', 'Unauthorized action.');
 }
 public function create()
 {
  return view('admin.createItems');
 }
 public function store(Request $request)
 {
  // Validate form data
  $request->validate([
   'name' => 'required|string',
   'price' => 'required|numeric',
   'slug' => 'required|string',
   'quantity' => 'required|integer',
   'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
  ]);

  // Handle file upload
  $photoPaths = []; // مصفوفة لتخزين مسارات الصور
  if ($request->hasFile('photos')) {
   foreach ($request->file('photos') as $photo) {
    $path = $photo->store('photos', 'public'); // تخزين الصورة
    $photoPaths[] = $path; // إضافة المسار إلى المصفوفة
   }
  }

  // Create new item and save to database
  $item = new Item();
  $item->name = $request->name;
  $item->price = $request->price;
  $item->slug = $request->slug;
  $item->description = $request->description;
  $item->quantity = $request->quantity;

  // حفظ المسارات في عمود الصور، تأكد من أن لديك العمود المناسب في جدول items
  $item->photos = json_encode($photoPaths); // حفظ المسارات بتنسيق JSON
  $item->save();
  // Redirect with success message
  return redirect()->route('items.index')->with('success', 'Item created successfully.');
 }
 public function ItemsAdmin()
 {
  // Define a unique cache key
  $cacheKey = 'items_admin_list';

  // Define cache duration (e.g., 60 minutes)
  $cacheDuration = 60;

  // Attempt to retrieve items from the cache
  $items = Cache::remember($cacheKey, $cacheDuration, function () {
   return Item::all();
  });

  return view('admin.showItems', ['items' => $items]);
 }
}
