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
  // Update info in JSON file
  $info = [
   'email' => $request->input('email'),
   'phone' => $request->input('phone'),
   'address' => $request->input('address'),
   'news' => $request->input('news'),
   'support_time' => $request->input('support_time'),
  ];

  $this->saveInfo($info);

  return redirect()->route('userinfo')->with('success', 'Information updated successfully!');
 }

 private function getInfo()
 {
  $infoFile = storage_path('app/info.json');
  $info = json_decode(file_get_contents($infoFile), true);

  return $info;
 }

 private function saveInfo($info)
 {
  $infoFile = storage_path('app/info.json');
  file_put_contents($infoFile, json_encode($info, JSON_PRETTY_PRINT));
 }
}
