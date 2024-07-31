<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SlugController extends Controller
{
 public function getItemsBySlug($slug)
 {
  // Define a unique cache key based on the slug
  $cacheKey = 'items_by_slug_' . md5($slug);
  $cacheDuration = 60; // Cache duration in minutes

  // Cache the items based on the slug
  $items = Cache::remember($cacheKey, $cacheDuration, function () use ($slug) {
   $parts = explode("-", $slug);
   if ($slug == "all") {
    return Item::all();
   } else {
    return Item::whereIn('slug', $parts)->get();
   }
  });

  return view('showCategory', ['items' => $items]);
 }
 public function getItemsByCaId($id)
 {
  // Define a unique cache key based on the category ID
  $cacheKey = 'items_by_ca_id_' . $id;
  $cacheDuration = 60; // Cache duration in minutes

  // Cache the items based on the category ID
  $items = Cache::remember($cacheKey, $cacheDuration, function () use ($id) {
   $ca = Categorie::findOrFail($id);
   $slug = $ca->slug;
   $parts = explode("-", $slug);
   return Item::whereIn('slug', $parts)->get();
  });

  return view('showCategory', ['items' => $items]);
 }
}
