<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
 use HasFactory;

 // Specify which attributes are mass assignable
 protected $fillable = [
  'user',
  'order',
  'address',
  'cart',
 ];

 // Cast the JSON columns to arrays
 protected $casts = [
  'user' => 'array',
  'order' => 'array',
  'address' => 'array',
  'cart' => 'array',
 ];
}
