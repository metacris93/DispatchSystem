<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /*public function test()
    {
        $orders = Order::with('drivers')->get();
        dd($orders);
    }*/
    public function index(Request $request)
    {
        $order = Order::find($request->id);
        if ($order == null)
        {
            return response()->json(["message" => "Order not found"], Response::HTTP_NOT_FOUND);
        }
        return response($order->toJson(), Response::HTTP_OK);
    }
    public function getAllOrders()
    {
        $orders = Order::all()->toJson();
        return response($orders, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $order = new Order();
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->store_id = $request->store_id;
        $order_status = OrderStatus::where('status', '=', 1)->first();
        $order->order_status_id = $order_status->id;
        $order->description = $request->description;
        $order->save();

        return response()->json([
            'message' => 'order record created'
        ], Response::HTTP_CREATED);
    }
}
