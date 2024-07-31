<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Http\Request;

class SearchController extends Controller
{
 public function search(Request $request)
 {
  $query = $request->input('query');
  $sort = $request->input('sort', '0'); // Default to '0' if no sort option is selected

  // Assuming you have a model named Item
  $itemsQuery = Item::where('name', 'like', "%{$query}%");

  // Apply sorting
  switch ($sort) {
   case '1':
    $itemsQuery->orderBy('price', 'asc');
    break;
   case '2':
    $itemsQuery->orderBy('price', 'desc');
    break;
   default:
    // Default sorting (e.g., by creation date)
    $itemsQuery->orderBy('created_at', 'desc');
    break;
  }

  $items = $itemsQuery->get();
  $categories = Categorie::all(); // Assuming you want to show all categories
  $categoriesSearch = Categorie::where('name', 'like', "%{$query}%")->get();

  return view('search.results', [
   'query' => $query,
   'items' => $items,
   'categories' => $categories,
   'categoriesSearch' => $categoriesSearch,
  ]);
 }
}
