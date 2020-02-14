<?php

use Illuminate\Database\Seeder;

class MaxNumberOfOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('max_number_orders')->insert([
            'value' => 2,
        ]);
    }
}
