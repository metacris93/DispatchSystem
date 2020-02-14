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

        $available_drivers = Driver::GetAvailableDrivers();
        if (count($available_drivers) == 0)
        {
            return response()->json([
                'message' => 'There is not an available driver'
            ], Response::HTTP_ACCEPTED);
        }
        $array_drivers_with_distances = array_map(array($order, 'CalculateDistance'), $available_drivers);
        arsort($array_drivers_with_distances);
        $nearest_driver = current($array_drivers_with_distances);

        $available_driver = Driver::SetStatusAvailable($nearest_driver[0]);
        $order->driver_id = $available_driver->id;
        $order->save();

        return response()->json([
            'message' => 'driver '. $available_driver->id . ' has an order'
        ], Response::HTTP_OK);
    }
}
