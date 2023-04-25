<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->decimal('price', 11,2);
            $table->text('address')->nullable();
            $table->string('ltd', 100)->nullable()->default('0.0000000');
            $table->string('lng', 100)->nullable()->default('0.0000000');
            $table->integer('status')->unsigned()->nullable()->default(2);
            $table->string('unitname', 200)->nullable();
            $table->string('heading', 200)->nullable();
            $table->string('office_id', 200)->nullable();
            $table->string('listing_agent', 200)->nullable();
            $table->string('property_status', 200)->nullable();
            $table->string('date_listed', 200)->nullable();
            $table->string('authority', 200)->nullable();
            $table->string('unique_id', 200)->nullable();
            $table->string('house_category', 200)->nullable();
            $table->string('inspection_date_from', 200)->nullable();
            $table->string('inspection_date_to', 200)->nullable();
            $table->string('inspection_time_from', 200)->nullable();
            $table->string('inspection_time_to', 200)->nullable();
            $table->string('featured_listing_status', 200)->nullable();
            $table->string('toilet', 200)->nullable();
            $table->string('ensuite', 200)->nullable();
            $table->string('garage', 200)->nullable();
            $table->string('carport', 200)->nullable();
            $table->string('parking_spaces', 200)->nullable();
            $table->string('rooms', 200)->nullable();
            $table->string('new_construction', 200)->nullable();
            $table->string('pool', 200)->nullable();
            $table->string('land_area', 200)->nullable();
            $table->string('land_unit', 200)->nullable();
            $table->string('building_area', 200)->nullable();
            $table->string('building_unit', 200)->nullable();
            $table->string('type', 200)->nullable();
            $table->string('code', 200)->nullable();
            $table->string('Floor', 200)->nullable();
            $table->string('unit_type', 200)->nullable();
            $table->string('lease_length', 200)->nullable();
            $table->string('no_of_Bedrooms', 200)->nullable();
            $table->string('bathrooms', 200)->nullable();
            $table->string('total_rooms', 200)->nullable();
            $table->string('square_foot', 200)->nullable();
            $table->string('features', 200)->nullable();
            $table->string('virtual_tour', 200)->nullable();
            $table->string('bathroom_features', 200)->nullable();
            $table->string('furry_friends', 200)->nullable();
            $table->string('transportation', 200)->nullable();
            $table->string('evicted', 200)->nullable();
            $table->timestamps();
        })  ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
