<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("phone");
            $table->string("order_id");
            $table->integer("item_count");
            $table->string("status");
            $table->string("token");
            $table->integer("total");
            $table->unsignedBigInteger("outlet_id");
            $table->string("delivery_location");
            $table->timestamps();

            $table->foreign("outlet_id")->references("id")->on("outlets");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
