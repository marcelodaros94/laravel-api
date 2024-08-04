<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Log request data
    \Log::info('Request Data:', $request->all());

    // Validate request data
    $validated = $request->validate([
        'order_number' => 'required|string',
        'products' => 'required',
        'order_date' => 'required|date',
        'receipt_date' => 'required|date',
        'dispatch_date' => 'required|date',
        'delivery_date' => 'required|date',
        'salesperson_id' => 'required|exists:users,id',
        'delivery_person_id' => 'required|exists:users,id',
        'order_status_id' => 'required|exists:order_statuses,id',
    ]);

    // Log validated data
    \Log::info('Validated Data:', $validated);

    // Create the order
    $order = Order::create($validated);

    // Log created order
    \Log::info('Created Order:', $order->toArray());

    return response()->json($order, 201);
}
}
