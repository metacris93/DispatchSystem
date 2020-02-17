<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use Symfony\Component\HttpFoundation\Response;
class DriverController extends Controller
{
    public function getOrders(Request $request)
    {
        $driver = Driver::find($request->id);
        if ($driver == null)
        {
            return response()->json(["message" => "Driver not found"], Response::HTTP_NOT_FOUND);
        }
        $orders = $driver->orders()->get()->toJson();
        return response($orders, Response::HTTP_OK);
    }
}
