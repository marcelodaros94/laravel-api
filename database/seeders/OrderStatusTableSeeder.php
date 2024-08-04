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
            ['name' => 'Por atender'],
            ['name' => 'En proceso'],
            ['name' => 'En delivery'],
            ['name' => 'Recibido']
        ]);
    }
}
