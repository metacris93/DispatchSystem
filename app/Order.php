<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /*
     FOREIGN KEY : store_id , order_status_id, driver_id 
    */
    public $timestamps = false;
    //protected $fillable = ['lat', 'lng'];
    public function CalculateDistance($driver)
    {
        return $this->HaversineDistance($driver);
    }
    function HaversineDistance($driver)
    {
        // distance between latitudes  and longitudes 
        $dLat = ($driver['lat'] - $this->lat) *
            M_PI / 180.0;
        $dLon = ($driver['lng'] - $this->lng) *
            M_PI / 180.0;

        // convert to radians 
        $lat1 = ($this->lat) * M_PI / 180.0;
        $lat2 = ($driver['lat']) * M_PI / 180.0;

        // apply formulae 
        $a = pow(sin($dLat / 2), 2) +
            pow(sin($dLon / 2), 2) *
            cos($lat1) * cos($lat2);
        $rad = 6371;
        $c = 2 * asin(sqrt($a));
        return array($driver['id'], $rad * $c);
    }
    public function driver()
    {
        return $this->belongsTo('App\Driver', 'driver_id');
    }
    public function order_status()
    {
        return $this->hasOne('App\OrderStatus', 'order_status_id');
    }
    public function store()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }
}
