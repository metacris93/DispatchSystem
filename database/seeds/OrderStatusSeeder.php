<?php

use Illuminate\Database\Seeder;
use App\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_status = new OrderStatus();
        $order_status->status = 0;
        $order_status->description = "En preparacion";
        $order_status->save();

        $order_status = new OrderStatus();
        $order_status->status = 1;
        $order_status->description = "Orden lista";
        $order_status->save();
    }
}
