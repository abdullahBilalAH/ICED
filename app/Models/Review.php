<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    protected $fillable = [
        'item_id',
        'reviewer_name',
        'reviwer_id',
        'review',
        'rating',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
