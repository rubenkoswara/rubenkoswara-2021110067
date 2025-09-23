<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini

class Product extends Model
{
    use HasFactory, SoftDeletes; // Pastikan SoftDeletes ada di sini

    protected $fillable = [
        'product_name',
        'price',
        'stock',
        'category',
        'description',
    ];
}