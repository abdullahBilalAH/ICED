<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\JsonFavoriteController;
use App\Http\Controllers\MainInfoController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RandomPagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SlugController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::fallback(function () {
 return redirect()->route('dashboard'); // Change 'dashboard' to the name of your dashboard route
});

Route::get('/', function () {
 return redirect()->route("adminDashboard");
});


Route::get('/dashboard', function () {
 // Define cache keys
 $itemsKey = 'dashboard_items';
 $lastItemsKey = 'dashboard_last_items';
 $mainInfoKey = 'dashboard_main_info';
 $categoriesKey = 'dashboard_categories';

 // Cache duration in minutes
 $cacheDuration = 60;

 // Cache items
 $items = Cache::remember($itemsKey, $cacheDuration, function () {
  return Item::all();
 });

 // Cache last 6 items
 $lastItems = Cache::remember($lastItemsKey, $cacheDuration, function () {
  return Item::orderBy('created_at', 'desc')->take(6)->get();
 });

 // Cache main info
 $mainInfo = Cache::remember($mainInfoKey, $cacheDuration, function () {
  $path = storage_path('app/mainInfo.json');

  // Check if the file exists
  if (!File::exists($path)) {
   return response()->json(['error' => 'File not found'], 404);
  }

  // Read the content of the file
  $jsonContent = File::get($path);

  // Decode the JSON content to an array
  return json_decode($jsonContent, true);
 });

 // Cache categories
 $categories = Cache::remember($categoriesKey, $cacheDuration, function () {
  return Categorie::all();
 });

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

 // Cache photo paths for items
 foreach ($items as $item) {
  $photosArray = json_decode($item->photos, true);
  $firstPhoto = $photosArray[0] ?? null;
  if ($firstPhoto) {
   Cache::put("photo_{$item->id}", Storage::url($firstPhoto), $cacheDuration);
  }
 }

 // Cache photo paths for categories
 foreach ($categories as $category) {
  if ($category->photos) {
   Cache::put("category_photo_{$category->id}", Storage::url('photos/' . $category->photos), $cacheDuration);
  }
 }

 return view("dashboard", [
  'categories' => $categories,
  'last6Items' => $lastItems,
  'mainInfo' => $mainInfo,
  'items' => $items,
  'categoriesById' => $categoriesById,
  'categoriesScroll' => $categoriesScroll,
  'featuredSection' => $featuredSection
 ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('test', function () {
 $info = json_decode(Storage::get('info.json'), true);
 $lastItems = Item::orderBy('created_at', 'desc')->take(6)->get();
 $jsonFilePath = storage_path('app/random_pages.json');
 $json = File::get($jsonFilePath);
 $links = json_decode($json, true);

 return view('layouts.main', ["last6Items" => $lastItems, "info" => $info, "links" => $links]);
});

Route::get("/out", function () {
 Auth::logout();
})->name("logout");

// Admin routes
Route::middleware('auth')->group(function () {

 Route::get('/Admin', [AdminController::class, 'index'])->middleware('admin')->name("adminDashboard");
 Route::get('/Admin/customers', [UserController::class, 'index'])->name('customerTable');
 Route::get('/Admin/{id}/edit', [UserController::class, 'edit'])->name("user.edit");
 Route::delete('/Admin/{id}', [UserController::class, "destroy"])->name('user.destroy');

 // Category routes
 Route::get('/Admin/categories', function () {
  return view("admin.categories", ['categories' => Categorie::all()]);
 })->name('categories.index');
 Route::delete('/Admin/categories/create/destroy/{id}', [CategoriesController::class, 'destroy'])->name("categorie.destroy");
 Route::get('/Admin/categories/create', [CategoriesController::class, 'index'])->name('categorie.index');
 Route::post('/Admin/categories/create/store', [CategoriesController::class, 'create'])->middleware('admin')->name("categories.create");

 // User show category
 Route::get('/categoriy/{slug}', [SlugController::class, 'getItemsBySlug'])->name('getItemsBySlug');
 Route::get('/categoriy/f/{id}', [SlugController::class, 'getItemsByCaId'])->name("getItemsByCategoryId");

 // Item routes
 Route::get('/item/{id}', [ItemController::class, 'index'])->name("item.index");
 Route::get('/Admin/items/create', [ItemsController::class, 'create'])->name('items.create');
 Route::post('/Admin/items/store', [ItemsController::class, 'store'])->name('items.store');
 Route::get('/Admin/items', [ItemsController::class, 'ItemsAdmin'])->name('items.index');
 Route::get('/Admin/item/{id}', function ($id) {
  return view('admin.showItem', ['item' => Item::find($id)]);
 })->name('admin.item.index');
});

Route::get('/test1', function () {
 return view('contact');
});
// Profile routes
Route::middleware('auth')->group(function () {
 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
 Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
 Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//info

Route::get('/userinfo', [InfoController::class, 'index'])->name('userinfo');
Route::post('/userinfo/update', [InfoController::class, 'update'])->name('userinfo.update');


//add and remove pages
Route::get('/Admin/random_pages/main', [RandomPagesController::class, "index"])->name("pages.index");
Route::get('/Admin/random_pages/create_normal', [RandomPagesController::class, "index_normal"])->name('pages.normal.index');
Route::post('/Admin/random_pages/create_normal', [RandomPagesController::class, 'store'])->name("pages.store");

Route::get('/Admin/random_pages/view/{title}', [RandomPagesController::class, 'showPages'])->name('page.view');

Route::get('/Admin/random_pages/footer_pages', [RandomPagesController::class, 'showForm'])->name('pages.form');
Route::post('/save-pages', [RandomPagesController::class, 'saveForm'])->name('pages.save');

Route::delete('/delete/{title}', [RandomPagesController::class, 'destroy'])->name('page.destroy');



//main info put

Route::get('/Admin/main-info/input', [MainInfoController::class, 'showInputForm'])->name('showInputForm');
Route::post('/Admin/main-info/save', [MainInfoController::class, 'saveMainInfo'])->name('saveMainInfo');


Route::middleware('auth')->group(function () {

 //cart
 Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
 Route::get('/cart/add/{id}/{qa}', [CartController::class, 'addItem'])->name('cart.add');
 Route::get('/s/cart/add/{id}/{qa}', [CartController::class, 'addItem'])->name('cart.addOne');

 Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
 // web.php
 Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
 Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
 // routes/web.php
 Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
 Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');


 Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');


 //favorite
 Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
 Route::get('/favorites/add/{id}', [FavoriteController::class, 'add'])->name('favorites.add');
 Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');

 Route::get('/json/favorites/add/{id}', [JsonFavoriteController::class, 'add'])->name('json.favorites.add');
 Route::post('/json/favorites/remove', [JsonFavoriteController::class, 'remove'])->name('json.favorites.remove');
});

Route::middleware('auth')->group(function () {

 //checkout

 Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

 Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::middleware('auth')->group(function () {

 //orders
 Route::get('/Admin/orders', [OrdersController::class, 'index'])->name('orders.index');
 Route::get('/Admin/order-chart', [OrdersController::class, 'chart'])->name('order.chart');


 Route::get('/Admin/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
 Route::post('genrate-orders-pdf/{id}', [PdfController::class, 'generateOrders'])->name('genrate.orders');
 Route::get('generate-all-orders-zip', [PdfController::class, 'generateAllOrdersZip'])->name('generate.all.orders.zip');

 //contact
 Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
 Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
 Route::get('/Admin/contact_messages', [ContactController::class, 'show'])->name('admin.contact.show')->middleware('auth');
 Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('subscribe');
 Route::get('/admin/subscribers', [ContactController::class, 'showSubscribers'])->name('admin.subscribers');

 Route::get('/search', [SearchController::class, 'search'])->name('search.results');
});


Auth::routes([
 'verify' => true
]);
require __DIR__ . '/auth.php';
