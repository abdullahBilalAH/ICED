<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
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
  View::composer(['extension.cart_index', 'dashboard', 'extension.favorite', 'normal.item', 'admin.categories', 'showCategory', 'extension.checkout'], function ($view) {
   // Retrieve data from the database
   $cart = session()->get('cart', []);
   $favorites = session()->get('favorites', []);
   $jsonFilePath = storage_path('app/random_pages.json');
   $json = File::get($jsonFilePath);
   $links = json_decode($json, true);

   $info = json_decode(Storage::get('info.json'), true);
   // Share data with specific views
   $view
    ->with('links', $links)
    ->with('info', $info)
    ->with('user', Auth::user())
    ->with('categories', Categorie::all())
    ->with('cart', $cart)
    ->with('favorites', $favorites);
  });
 }
}
