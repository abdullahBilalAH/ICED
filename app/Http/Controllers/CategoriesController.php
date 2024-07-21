<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
 public function __construct()
 {
  $this->middleware('admin')->except('error', 'Unauthorized action.');
 }
 public function index()
 {

  return view('admin.createCategories');
 }
 public function create(Request $request)
 {
  // Validate the request
  $validatedData = $request->validate([
   'name' => 'required|string|max:255',
   'slug' => 'required|string|max:255|unique:categories,slug',
   'description' => 'nullable|string',
   'last_used_at' => 'nullable|date',
   'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for the photo
  ]);

  // Handle file upload
  if ($request->hasFile('photo')) {
   $fileName = time() . '.' . $request->photo->extension();
   $request->photo->storeAs('photos', $fileName, 'public');
  }

  // Create a new category
  $category = new Categorie();
  $category->name = $validatedData['name'];
  $category->slug = $validatedData['slug'];
  $category->description = $validatedData['description'];
  $category->last_used_at = now();
  $category->visibility = "true";

  if (isset($fileName)) {
   $category->photos = $fileName; // Save the filename in the database
  }

  $category->save();

  return redirect()->route('categories.index')->with('success', 'Category created successfully.');
 }
 public function destroy($id)
 {
  // Find the item by its ID
  $categorie = categorie::find($id);
  if (!$categorie) {
   return redirect()->route('categories.index')->with('error', 'Item not found.');
  }

  // Delete the item
  $categorie->delete();

  // Optionally, you can return a response or redirect
  return redirect()->route('categories.index')->with('success', 'Item deleted successfully.');
 }
}
