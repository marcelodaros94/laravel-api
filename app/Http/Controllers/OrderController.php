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
        // Validate the request
        $validatedData = $request->validate([
            'order_number' => 'required|string|max:255|unique:orders',
            'products' => 'required|array',
            'order_date' => 'required|date',
            'receipt_date' => 'nullable|date',
            'dispatch_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'salesperson_id' => 'required|exists:users,id',
            'delivery_person_id' => 'nullable|exists:users,id',
            'order_status_id' => 'required|exists:order_statuses,id',
        ]);

        // Create the order
        $order = Order::create($validatedData);

        return response()->json($order, 201);
    }
}
