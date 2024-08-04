<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            ['name' => 'Por atender', 'order' => 1],
            ['name' => 'En proceso', 'order' => 2],
            ['name' => 'En delivery', 'order' => 3],
            ['name' => 'Recibido', 'order' => 4],
        ]);
    }
}
