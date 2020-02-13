<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;
    protected $casts = [
        'available' => 'boolean'
    ];
    public static function isAvailableToDispatchAnOrder(Driver $driver)
    {
        $max_number_orders = \DB::table('max_number_orders')->get()->first()->value;
        $orders_counter = $driver->orders()->count();
        return $max_number_orders > $orders_counter;
    }
    public static function GetAvailableDrivers()
    {
        return Driver::where('available', true)->get()->toArray();
    }
    public static function isReachedMaximunNumberOfDeliveries(Driver $driver)
    {
        $max_number_orders = \DB::table('max_number_orders')->get()->first()->value;
        $orders_counter = $driver->orders()->count();
        return ($max_number_orders - $orders_counter == 1);
    }
    public static function SetStatusAvailable($id)
    {
        $driver = Driver::find($id);
        $driver->available = !Driver::isReachedMaximunNumberOfDeliveries($driver);
        $driver->save();
        return $driver;
    }
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
