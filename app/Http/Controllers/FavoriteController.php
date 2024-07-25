<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
 public function index(Request $request)
 {
  // Retrieve favorite items from session
  $favoriteItems = session()->get('favorites', []);

  // Retrieve items details based on IDs from session (static for now)
  $items = $this->getItemsDetails($favoriteItems);

  return view('extension.favorite', compact('items'));
 }

 public function add($id)
 {
  // Add item ID to favorites in session
  $favorites = session()->get('favorites', []);
  if (!in_array($id, $favorites)) {
   $favorites[] = $id;
   session()->put('favorites', $favorites);
  }

  return redirect()->back()->with('success', 'Item added to favorites!');
 }

 public function remove(Request $request)
 {
  $itemId = $request->input('id');

  // Remove item ID from favorites in session
  $favorites = session()->get('favorites', []);
  if (($key = array_search($itemId, $favorites)) !== false) {
   unset($favorites[$key]);
   session()->put('favorites', $favorites);
  }

  return redirect()->back()->with('success', 'Item deleted from favorites!');
 }

 private function getItemsDetails($favoriteItems)
 {
  // Retrieve all items from the database
  $allItems = Item::all();

  // Filter items based on favoriteItems
  return $allItems->filter(function ($item) use ($favoriteItems) {
   return in_array($item->id, $favoriteItems);
  })->toArray();
 }
}
