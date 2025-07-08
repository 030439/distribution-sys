<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'sku',
        'active',
        'image_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'active' => 'boolean',
        'stock_quantity' => 'integer',
    ];
}
