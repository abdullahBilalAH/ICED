<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

  return view("normal.item", ["item" => $item, "reviews" => $reviews]);
 }
 public function getReviewsByItemId($itemId)
 {
  $reviews = Review::where('item_id', $itemId)->get();
 }
}
