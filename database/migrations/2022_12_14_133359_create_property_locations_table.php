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
        Schema::create('property_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('parcel_number', 100)->nullable();
            $table->string('middle_school', 100)->nullable();
            $table->string('area', 100)->nullable();
            $table->string('high_school', 100)->nullable();
            $table->string('elementary_school', 100)->nullable();
            $table->string('subdivision', 100)->nullable();
            $table->string('school_district', 100)->nullable();
            $table->string('geo_market_area', 100)->nullable();
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
        Schema::dropIfExists('property_locations');
    }
};
