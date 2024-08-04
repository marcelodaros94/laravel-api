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

        $order = Order::create($validated);

        return response()->json($order, 201);
    }
}
