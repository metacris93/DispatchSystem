<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;
    protected $casts = [
        'available' => 'boolean'
    ];
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
