<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->integer("device_id")->nullable();
            $table->integer("user_id")->nullable();
            $table->string("keyword")->nullable();
            $table->string("type")->nullable();
            $table->string("input_type")->nullable();
            $table->string("url")->nullable();
            $table->unsignedBigInteger("content_id");
            $table->string("api_method")->nullable();
            $table->string("next_flow")->nullable();
            $table->timestamps();

            $table->foreign("content_id")->references("id")->on("contents");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flows');
    }
}
