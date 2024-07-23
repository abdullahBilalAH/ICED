<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Http\Request;

class SlugController extends Controller
{
 public function getItemsBySlug($slug)
 {
  $parts = explode("-", $slug);
  $items = Item::whereIn('slug', $parts)->get();
  if ($slug == "all") {
   $items = Item::all();
  }
  return view('showCategory', ['items' => $items]);
 }
 public function getItemsByCaId($id)
 {
  $ca = Categorie::findOrFail($id); // Get the category by ID, assuming it's a single ID
  $slug = $ca->slug;
  $parts = explode("-", $slug);
  $items = Item::whereIn('slug', $parts)->get();

  return view('showCategory', ['items' => $items]);
 }
}
