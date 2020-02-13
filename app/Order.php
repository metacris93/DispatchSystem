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
