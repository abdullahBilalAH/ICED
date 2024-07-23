<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MainInfoController extends Controller
{

 public function __construct()
 {
  $this->middleware('admin')->except('error', 'Unauthorized action.');
 }
 public function showInputForm()
 {
  $path = storage_path('app/mainInfo.json');

  // Load existing data if the file exists
  $data = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

  // Get all categories
  $categories = Categorie::all();

  return view('mainInfo.storeData', compact('data', 'categories'));
 }





 public function saveMainInfo(Request $request)
 {
  $path = storage_path('app/mainInfo.json');

  // Validate input data
  $request->validate([
   'hero_page.img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
   'banner1.img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
   'banner2.img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
   'hero_page.category' => 'nullable|exists:categories,id',
   'banner1.category' => 'nullable|exists:categories,id',
   'banner2.category' => 'nullable|exists:categories,id',
   'categories_scroll' => 'array',
   'categories_scroll.*' => 'nullable|exists:categories,id',
   'featured_section' => 'array|max:5',
   'featured_section.*' => 'nullable|exists:categories,id',
   'hero_page.txt' => 'nullable|string',
  ]);

  // Upload images and get their paths
  $heroImagePath = $request->file('hero_page.img') ? $request->file('hero_page.img')->store('public/photos') : '';
  $banner1ImagePath = $request->file('banner1.img') ? $request->file('banner1.img')->store('public/photos') : '';
  $banner2ImagePath = $request->file('banner2.img') ? $request->file('banner2.img')->store('public/photos') : '';

  // Prepare data for saving
  $data = [
   'hero_page' => [
    'img' => $heroImagePath,
    'category' => $request->input('hero_page.category', ''),
    'txt' => $request->input('hero_page.txt', ''),  // Added txt field
   ],
   'categories_scroll' => array_filter($request->input('categories_scroll', [])),
   'Featured Section' => array_filter($request->input('featured_section', [])),
   'banner1' => [
    'img' => $banner1ImagePath,
    'category' => $request->input('banner1.category', ''),
   ],
   'banner2' => [
    'img' => $banner2ImagePath,
    'category' => $request->input('banner2.category', ''),
   ],
  ];

  // Save data to JSON file
  File::put($path, json_encode($data, JSON_PRETTY_PRINT));

  return redirect()->route('showInputForm')->with('success', 'Main info saved successfully!');
 }
}
