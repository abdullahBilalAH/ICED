<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
 use HasFactory;

 // The table associated with the model.
 protected $table = 'discounts';

 // The attributes that are mass assignable.
 protected $fillable = [
  'code',
  'percent',
  'count',
  'countLimit',
  'timeLimit',
 ];

 // The attributes that should be cast to native types.
 protected $casts = [
  'percent' => 'float',
  'countLimit' => 'integer',
  'timeLimit' => 'datetime',
 ];
}
