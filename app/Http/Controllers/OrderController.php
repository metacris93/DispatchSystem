<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = new Order();
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->store_id = $request->store_id;
        $order_status = OrderStatus::where('status', '=', 1)->first();
        $order->order_status_id = $order_status->id;
        //dd($order_status);
        $order->save();

        return response()->json([
            'message' => 'order record created'
        ], 201);
    }
}
