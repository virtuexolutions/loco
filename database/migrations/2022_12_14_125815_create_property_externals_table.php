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
        Schema::create('property_externals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('foundation', 100)->nullable();
            $table->string('street_surface', 100)->nullable();
            $table->string('garage_description', 100)->nullable();
            $table->string('lot_description', 100)->nullable();
            $table->string('acres_description', 100)->nullable();
            $table->string('front_door_faces', 100)->nullable();
            $table->string('style', 100)->nullable();
            $table->string('pool_private_description', 100)->nullable();
            $table->text('garage_carport')->nullable();
            $table->string('access', 100)->nullable();
            $table->string('lot_size', 100)->nullable();
            $table->string('number_of_garage_capacity', 100)->nullable();
            $table->text('exterior')->nullable();
            $table->string('roof', 100)->nullable();
            $table->string('stories', 100)->nullable();
            $table->string('pool_area', 100)->nullable();
            $table->string('pool_private', 100)->nullable();
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
        Schema::dropIfExists('property_externals');
    }
};
