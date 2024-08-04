<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->json('products');
            $table->timestamp('order_date');
            $table->timestamp('receipt_date')->nullable();
            $table->timestamp('dispatch_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->foreignId('salesperson_id')->constrained('users');
            $table->foreignId('delivery_person_id')->constrained('users');
            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
