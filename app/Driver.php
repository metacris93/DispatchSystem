<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
