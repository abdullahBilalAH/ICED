<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
 /**
  * Register any application services.
  */
 public function register(): void
 {
  //
 }

 /**
  * Bootstrap any application services.
  */
 public function boot(): void
 {
  View::composer([
   'extension.cart_index',
   'dashboard',
   'extension.favorite',
   'normal.item',
   'admin.categories',
   'showCategory',
   'extension.checkout',
   'contact',
   'search.results'
  ], function ($view) {
   // Define unique cache keys for each data type
   $cartKey = 'session_cart';
   $favoritesKey = 'session_favorites';
   $linksKey = 'json_links';
   $infoKey = 'json_info';
   $categoriesKey = 'categories_all';

   // Cache duration in minutes
   $cacheDuration = 60;

   // Cache cart data
   $cart = Cache::remember($cartKey, $cacheDuration, function () {
    return session()->get('cart', []);
   });

   // Cache favorites data
   $favorites = Cache::remember($favoritesKey, $cacheDuration, function () {
    return session()->get('favorites', []);
   });

   // Cache JSON data
   $links = Cache::remember($linksKey, $cacheDuration, function () {
    $jsonFilePath = storage_path('app/random_pages.json');
    $json = File::get($jsonFilePath);
    return json_decode($json, true);
   });

   $info = Cache::remember($infoKey, $cacheDuration, function () {
    return json_decode(Storage::get('info.json'), true);
   });

   // Cache categories data
   $categories = Cache::remember($categoriesKey, $cacheDuration, function () {
    return Categorie::all();
   });

   // Share data with specific views
   $view
    ->with('links', $links)
    ->with('info', $info)
    ->with('user', Auth::user())
    ->with('categories', $categories)
    ->with('cart', $cart)
    ->with('favorites', $favorites);
  });
 }
}
