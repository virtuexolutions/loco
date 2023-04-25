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
        Schema::create('property_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subdivision', 100)->nullable();
            $table->string('listing_id', 100)->nullable();
            $table->string('full_baths', 100)->nullable();
            $table->string('property_type', 100)->nullable();
            $table->string('price', 100)->nullable();
            $table->string('bedrooms', 100)->nullable();
            $table->string('county', 100)->nullable();
            $table->string('year_built', 100)->nullable();
            $table->string('total_baths', 100)->nullable();
            $table->string('price_sqft', 100)->nullable();
            $table->string('partial_baths', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('sqFt', 100)->nullable();
            $table->string('totalbaths', 100)->nullable();
            $table->string('acres', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state_abrv', 100)->nullable();
            $table->string('zip4-idx_hidden', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('street_name', 100)->nullable();
            $table->string('number', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->text('details_link')->nullable();
            $table->string('longitude', 100)->nullable();
            $table->string('zip_idx_hidden', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->text('contact_info')->nullable();
            $table->string('detailsAddressRegion', 100)->nullable();
            $table->string('detailsAddressStreet', 100)->nullable();
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
        Schema::dropIfExists('property_details');
    }
};
