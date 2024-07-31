<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonFavoriteController extends Controller
{
 public function remove(Request $request)
 {
  $itemId = $request->input('id');

  // إزالة معرف العنصر من المفضلة في الجلسة
  $favorites = session()->get('favorites', []);
  if (($key = array_search($itemId, $favorites)) !== false) {
   unset($favorites[$key]);
   session()->put('favorites', $favorites);
  }

  return response()->json(['success' => true, 'message' => 'Item deleted from favorites!']);
 }

 public function add($id)
 {
  $favorites = session()->get('favorites', []);
  if (!in_array($id, $favorites)) {
   $favorites[] = $id;
   session()->put('favorites', $favorites);
  }

  return response()->json(['success' => true, 'message' => 'Item added to favorites!']);
 }
}
