<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'products',
        'order_date',
        'receipt_date',
        'dispatch_date',
        'delivery_date',
        'salesperson_id',
        'delivery_person_id',
        'order_status_id',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
