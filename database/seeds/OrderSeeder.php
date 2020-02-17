<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Store;
use App\Order;
use App\OrderStatus;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $stores = Store::all();
        $order_status = OrderStatus::where('status', '=', 1)->first();
        foreach ($stores as $store)
        {
            $order = new Order();
            $order->lat = $faker->randomFloat(8, -90, 90);
            $order->lng = $faker->randomFloat(8, -180, 180);
            $order->store_id = $store->id;
            $order->order_status_id = $order_status->id;
            $order->description = $faker->text(20);
            $order->save();
        }
    }
}
