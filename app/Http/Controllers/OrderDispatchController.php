<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Driver;
use App\Store;
use App\OrderStatus;
use Symfony\Component\HttpFoundation\Response;

class OrderDispatchController extends Controller
{
    private function CalculateDistance(Store $store, Driver $driver)
    {
        return $this->HaversineDistance($store, $driver);
    }
    // este metodo es invocado cuando se crea la orden (pedido)
    public function DispatchOrder(Request $request)
    {
        $order = new Order();
        $order->lat = $request->lat;
        $order->lng = $request->lng;
        $order->store_id = $request->store_id;
        $order_status = OrderStatus::where('status', '=', 1)->first();
        $order->order_status_id = $order_status->id;
        $order->description = $request->description;

        $drivers = Driver::all()->toArray();
        $new_drivers = array_map(array($order, 'CalculateDistance'), $drivers);
        arsort($new_drivers);
        $driver = current($new_drivers);

        //dd($driver);
        $nearest_driver = Driver::find($driver[0]);
        $nearest_driver->available = false;
        $nearest_driver->save();

        $order->driver_id = $nearest_driver->id;
        $order->save();

        return response()->json([
            'message' => 'driver has an order'
        ], Response::HTTP_OK);
    }
}
