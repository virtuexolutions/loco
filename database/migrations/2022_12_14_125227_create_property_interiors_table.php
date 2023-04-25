<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_interiors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('dishwasher', 100)->nullable();
            $table->string('heat_system', 100)->nullable();
            $table->string('disposal', 100)->nullable();
            $table->text('room_description')->nullable();
            $table->text('bedroom_description')->nullable();
            $table->string('microwave', 100)->nullable();
            $table->string('icemaker', 100)->nullable();
            $table->string('connections', 100)->nullable();
            $table->string('compactor', 100)->nullable();
            $table->string('floors', 100)->nullable();
            $table->string('master_bath_description', 100)->nullable();
            $table->string('cool_system', 100)->nullable();
            $table->string('interior', 100)->nullable();
            $table->string('oven_type', 100)->nullable();
            $table->string('fireplace_description', 100)->nullable();
            $table->string('countertops', 100)->nullable();
            $table->foreign('property_id')->references('id')->on('property_details')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_interiors');
    }
};
