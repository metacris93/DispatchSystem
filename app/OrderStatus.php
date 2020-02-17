<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
