<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
 use HasFactory;
 protected $table = "items";
 protected $fillable = [
  'name',
  'slug',
  'price',
  'description',
  'qunatity',
 ];

 public function reviews()
 {
  return $this->hasMany(Review::class);
 }
 public function getFirstPhotoAttribute()
 {
  // Ensure the photos attribute is decoded to an array
  $photos = $this->photos;
  return $photos[0] ?? null;
 }
}
