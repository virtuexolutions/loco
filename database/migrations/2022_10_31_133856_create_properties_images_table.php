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
        Schema::create('properties_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('property_id');
            $table->string('image_url', 100)->nullable();
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('property_id')->references('id')->on('property_details')->onDelete('cascade');
            //SETTING THE PRIMARY KEYS
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
        Schema::dropIfExists('properties_images');
    }
};
