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
        Schema::create('property', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->text('specials')->nullable();
            $table->string('supmarket', 100)->nullable();
            $table->string('built', 100)->nullable();
            $table->string('bath', 100)->nullable();
            $table->string('rent', 100)->nullable();
            $table->string('send', 100)->nullable();
            $table->string('escort', 100)->nullable();
            $table->string('commission', 100)->nullable();
            $table->string('bonus', 100)->nullable();
            $table->string('studio_net_cost', 100)->nullable();
            $table->string('br_starting_1', 100)->nullable();
            $table->string('br_starting_2', 100)->nullable();
            $table->string('br_3', 100)->nullable();
            // $table->string('amenity', 100)->nullable();
            // $table->string('floorplan', 100)->nullable();
            $table->string('br_den_1', 100)->nullable();
            $table->string('2_bed_den', 100)->nullable();
            $table->string('penthouse', 100)->nullable();
            $table->string('amenity_fees', 100)->nullable();
            $table->string('essential_housing_available', 100)->nullable();
            $table->string('flooring', 100)->nullable();
            $table->string('flooring_color', 100)->nullable();
            $table->string('flooring_color_2', 100)->nullable();
            $table->string('cabinet_color', 100)->nullable();
            $table->string('cabinet_color_2', 100)->nullable();
            $table->string('counter_top_color', 100)->nullable();
            $table->string('counter_color_2', 100)->nullable();
            $table->string('stand_up_showers', 100)->nullable();
            $table->string('garden_tubs', 100)->nullable();
            $table->string('pool', 100)->nullable();
            $table->string('roof_top_pool', 100)->nullable();
            $table->string('lap_pool', 100)->nullable();
            $table->string('heated_pool', 100)->nullable();
            $table->string('hot_tub', 100)->nullable();
            $table->string('sauna', 100)->nullable();
            $table->string('fitness_center', 100)->nullable();
            $table->string('floor_to_ceiling_windows', 100)->nullable();
            $table->string('downtown_views', 100)->nullable();
            $table->string('private_yards', 100)->nullable();
            $table->string('stories', 100)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('pet_spa', 100)->nullable();
            $table->string('rooftop_amenities', 100)->nullable();
            $table->string('washer_dryer_in_unit', 100)->nullable();
            $table->string('washer_dryer_laundry_facility on_site', 100)->nullable();
            $table->string('apartment_name', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('latitude', 100)->nullable();
            $table->string('longitude', 100)->nullable();
            // $table->string('specials', 100)->nullable();
            $table->string('year_built_renovated', 100)->nullable();
            $table->string('bedrooms', 100)->nullable();
            $table->string('price_range', 100)->nullable();
            // $table->string('send', 100)->nullable();
            // $table->string('escort', 100)->nullable();
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
        Schema::dropIfExists('property');
    }
};
