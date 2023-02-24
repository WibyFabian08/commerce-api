<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_temps', function (Blueprint $table) {
            $table->id();
            $table->string("phone")->nullable();
            $table->unsignedBigInteger("outlet_id");
            $table->string("order_type")->nullable();
            $table->string("location")->nullable();
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
        Schema::dropIfExists('order_temps');
    }
}
