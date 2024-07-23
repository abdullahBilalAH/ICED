<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MainInfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RandomPagesController;
use App\Http\Controllers\SlugController;
use App\Http\Controllers\UserController;
use App\Models\Categorie;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
 return view('welcome');
});

Route::get('/dashboard', function () {
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
 $mainInfoData = json_decode($jsonContent, true);
 return view("dashboard", ['categories' => Categorie::all(), "last6Items" => $lastItems, "info" => $info, "links" => $links, "mainInfo" => $mainInfoData, 'items' => $items]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('test', function () {
 $info = json_decode(Storage::get('info.json'), true);
 $lastItems = Item::orderBy('created_at', 'desc')->take(6)->get();
 $jsonFilePath = storage_path('app/random_pages.json');
 $json = File::get($jsonFilePath);
 $links = json_decode($json, true);

 return view("test", ['categories' => Categorie::all(), "last6Items" => $lastItems, "info" => $info, "links" => $links]);
});

Route::get("/out", function () {
 Auth::logout();
});

// Admin routes
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


Route::get('/test1/{id}', [ItemController::class, 'index']);
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

require __DIR__ . '/auth.php';


//main info put

Route::get('/Admin/main-info/input', [MainInfoController::class, 'showInputForm'])->name('showInputForm');
Route::post('/Admin/main-info/save', [MainInfoController::class, 'saveMainInfo'])->name('saveMainInfo');
