<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('store_id', '=', $request->id)->get();
        //$order = Order::where('id', '=', $request->id)->get();
        //$order = Order::find($request->id)->toArray();
        if ($orders == null)
        {
            return response()->json(["message" => "Order not found"], Response::HTTP_NOT_FOUND);
        }
        return response()->json($orders, Response::HTTP_OK);
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
