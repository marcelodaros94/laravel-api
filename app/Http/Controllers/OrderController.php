<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Validation\ValidationException;

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

    public function updateStatus(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'order_status_id' => 'required',
        ]);

        $newStatusId = $validatedData['order_status_id']; // 0
        $currentStatus = OrderStatus::find($order->order_status_id); // 1         
        $newStatus = OrderStatus::find($newStatusId);
        $newStatusOrder = $newStatus->order;
        
        // Check if the new status is not lower than the current status
        if ($newStatus->order < $currentStatus->order) {
            throw ValidationException::withMessages(['order_status_id' => 'Cannot downgrade to a lower status.']);
        }

        // Update the order status and relevant dates
        $order->order_status_id = $newStatusId;

        switch ($newStatusOrder) {
            case 1:
                $order->order_date = now();
                break;
            case 2:
                $order->receipt_date = now();
                break;
            case 3:
                $order->dispatch_date = now();
                break;
            case 4:
                $order->delivery_date = now();
                break;
        }

        $order->save();

        return response()->json($order, 200);
    }
}
