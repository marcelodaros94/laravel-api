<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku', 'name', 'product_type_id', 'tags', 'price', 'measurement_unit_id'];

    protected $casts = [
        'tags' => 'array',
    ];
}
