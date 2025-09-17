<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   use HasFactory;
    
    // Tentukan kolom mana yang bisa diisi
    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'category',
        'description',
    ];
}
