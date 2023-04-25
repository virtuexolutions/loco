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
        Schema::create('property_primary_features', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('subdivision', 100)->nullable();
            $table->string('half_baths', 100)->nullable();
            $table->string('county', 100)->nullable();
            $table->string('year_built', 100)->nullable();
            $table->string('price_sqft', 200)->nullable();
            $table->string('property_type', 100)->nullable();
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
        Schema::dropIfExists('property_primary_features');
    }
};
