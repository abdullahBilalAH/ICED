<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RandomPagesController extends Controller
{
 public function __construct()
 {
  $this->middleware('admin')->except('error', 'Unauthorized action.');
 }
 public function index()
 {
  $dirPath = 'pages';
  if (!Storage::exists($dirPath)) {
   Storage::makeDirectory($dirPath);
  }

  $files = Storage::files($dirPath);
  $pages = [];

  foreach ($files as $file) {
   $pageData = json_decode(Storage::get($file), true);
   $pages[] = $pageData;
  }

  return view("random_pages.main", ['pages' => $pages]);
 }
 public function index_normal()
 {
  return view("random_pages.normal");
 }
 public function store(Request $request)
 {

  // Load JSON data from file

  $request->validate([
   'title' => 'required|string|max:255',
   'content' => 'required|string',
  ]);

  $pageData = [
   'title' => $request->input('title'),
   'content' => $request->input('content'),
   'side_bar' => $request->has('side_bar'),
  ];

  $dirPath = 'pages';
  if (!Storage::exists($dirPath)) {
   Storage::makeDirectory($dirPath);
  }

  $fileName = Str::slug($request->input('title'), '_') . '.json';
  $filePath = $dirPath . '/' . $fileName;

  Storage::put($filePath, json_encode($pageData, JSON_PRETTY_PRINT));
  return redirect()->back()->with('success', 'Page created successfully.');
 }
 public function showPages($title)
 {
  $jsonFilePath = storage_path('app/random_pages.json');
  $json = File::get($jsonFilePath);
  $links = json_decode($json, true); // Decode JSON to an associative array
  // Sanitize and convert the title to a slug for the file name
  $fileName = Str::slug($title, '_') . '.json';
  $filePath = 'pages/' . $fileName;
  $info = json_decode(Storage::get('info.json'), true);
  $lastItems = Item::orderBy('created_at', 'desc')->take(6)->get();

  // Check if the file exists
  if (Storage::exists($filePath)) {
   // Get the file content
   $pageData = json_decode(Storage::get($filePath), true);

   // Pass the data to the view
   return view('random_pages.show', ['page' => $pageData, 'categories' => Categorie::all(), "last6Items" => $lastItems, "info" => $info, "links" => $links]);
  } else {
   // Handle the case when the file is not found
   return redirect()->back()->with('error', 'Page not found.');
  }
 }
 public function index_footer()
 {
  $files = Storage::disk('local')->files('pages');
  $pages = array_map('basename', $files);

  return view('random_pages.footer_pages');
 }
 public function showForm()
 {
  // Load JSON data from file
  $jsonFilePath = storage_path('app/random_pages.json');
  $json = file_exists($jsonFilePath) ? file_get_contents($jsonFilePath) : '{}';
  $pages = json_decode($json, true); // Decode JSON to an associative array
  $files = Storage::disk('local')->files('pages');
  $jsonFiles = array_filter($files, function ($file) {
   return pathinfo($file, PATHINFO_EXTENSION) === 'json';
  });

  $fileNames = array_map(function ($file) {
   return pathinfo($file, PATHINFO_FILENAME); // Get filename without extension
  }, $jsonFiles);
  return view('random_pages.footer_pages', ['pages' => $pages, 'titles' => $fileNames]);
 }
 public function saveForm(Request $request)
 {
  // Collect form data
  $data = $request->only([
   'page1', 'page2', 'page3', 'page4', 'page5',
   'page6', 'page7', 'page8', 'page9', 'page10',
   'page11', 'page12'
  ]);

  // Convert null values to empty strings
  $data = array_map(function ($value) {
   return $value === null ? '' : $value;
  }, $data);

  // Convert data to JSON and save to file
  $jsonData = json_encode($data, JSON_PRETTY_PRINT);
  Storage::put('random_pages.json', $jsonData);

  return redirect()->route('pages.form')->with('success', 'Changes saved successfully!');
 }
 public function destroy($title)
 {
  // Construct the filename and path with cross-platform separator
  $filePath = storage_path('app/pages/' . $title . '.json');

  // Debug: Print the path to ensure it's correct

  // Check if the file exists using PHP native function
  if (file_exists($filePath)) {
   // Delete the file
   unlink($filePath);
   return redirect()->route('pages.index')->with('success', 'File deleted successfully!');
  } else {
   return redirect()->route('pages.index')->with('error', 'File not found.');
  }
 }
}
