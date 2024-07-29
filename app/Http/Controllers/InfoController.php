<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
 public function index()
 {
  // Read info from JSON file
  $info = $this->getInfo();

  return view('admin.userinfo', compact('info'));
 }

 public function update(Request $request)
 {
  // Validate the request
  $request->validate([
   'email' => 'required|email',
   'phone' => 'required|string',
   'address' => 'required|string',
   'news' => 'required|string',
   'support_time' => 'required|string',
   'open_time' => 'nullable|string',
   'location' => 'nullable|string',
  ]);

  // Update info in JSON file
  $info = [
   'email' => $request->input('email'),
   'phone' => $request->input('phone'),
   'address' => $request->input('address'),
   'news' => $request->input('news'),
   'support_time' => $request->input('support_time'),
   'open_time' => $request->input('open_time'),
   'location' => $request->input('location'),
  ];

  $this->saveInfo($info);

  return redirect()->route('userinfo')->with('success', 'Information updated successfully!');
 }

 private function getInfo()
 {
  $infoFile = storage_path('app/info.json');
  if (!file_exists($infoFile)) {
   // If file does not exist, return default values
   return [
    'email' => '',
    'phone' => '',
    'address' => '',
    'news' => '',
    'support_time' => '',
    'open_time' => '',
    'location' => '',
   ];
  }

  $info = json_decode(file_get_contents($infoFile), true);
  return $info;
 }

 private function saveInfo($info)
 {
  $infoFile = storage_path('app/info.json');
  file_put_contents($infoFile, json_encode($info, JSON_PRETTY_PRINT));
 }
}
