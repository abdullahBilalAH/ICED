<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mockery\Undefined;

class ItemController extends Controller
{
 public function index($id)
 {
  $item = Item::find($id);

  $reviews = Review::where('item_id', $id)->get();

  if ($reviews->isEmpty()) {
   // Create a new instance with default values
   $newReview = new Review();
   $newReview->item_id = $id; // Assign the item_id you're querying for
   $newReview->reviewer_name = " "; // Set default values
   $newReview->reviwer_id = "0";
   $newReview->review = " ";
   $newReview->rating = 0;

   // Assign $newReview to $reviews as a collection with one item
   $reviews = collect([$newReview]);
  }
  $items = Item::all();
  $info = json_decode(Storage::get('info.json'), true);
  $lastItems = Item::orderBy('created_at', 'desc')->take(6)->get();
  $jsonFilePath = storage_path('app/random_pages.json');
  $json = File::get($jsonFilePath);
  $links = json_decode($json, true);
  //mainInfo
  $path = storage_path('app/mainInfo.json');

  // Check if the file exists
  if (!File::exists($path)) {
   return response()->json(['error' => 'File not found'], 404);
  }

  // Read the content of the file
  $jsonContent = File::get($path);

  // Decode the JSON content to an array
  $mainInfo = json_decode($jsonContent, true);

  $categories = Categorie::all();

  // Extract IDs from mainInfo arrays
  $categoriesScrollIds = $mainInfo['categories_scroll'] ?? [];
  $featuredSectionIds = $mainInfo['Featured Section'] ?? [];

  // Convert categories to a keyed array by ID for easy lookup
  $categoriesById = $categories->keyBy('id');

  // Filter categories based on the IDs in mainInfo
  $categoriesScroll = $categories->filter(function ($category) use ($categoriesScrollIds) {
   return in_array($category->id, $categoriesScrollIds);
  });

  $featuredSection = $categories->filter(function ($category) use ($featuredSectionIds) {
   return in_array($category->id, $featuredSectionIds);
  });


  return view("normal.item", ["item" => $item, "reviews" => $reviews, 'categories' => $categories, "last6Items" => $lastItems, "info" => $info, "links" => $links, "mainInfo" => $mainInfo, 'items' => $items, 'categoriesById' => $categoriesById, "categoriesScroll" => $categoriesScroll, "featuredSection" => $featuredSection]);
 }
 public function getReviewsByItemId($itemId)
 {
  $reviews = Review::where('item_id', $itemId)->get();
 }
}
