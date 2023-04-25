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
        Schema::create('property_additionals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('annual_maintenance_description', 100)->nullable();
            $table->string('hoa_website', 100)->nullable();
            $table->string('master_planned_community', 100)->nullable();
            $table->string('restrictions', 100)->nullable();
            $table->string('energy', 200)->nullable();
            $table->string('legal', 100)->nullable();
            $table->string('new_construction', 100)->nullable();
            $table->string('year_built_source', 100)->nullable();
            $table->string('exemptions', 100)->nullable();
            $table->string('management_company_name', 100)->nullable();
            $table->string('vacation_rental', 100)->nullable();
            $table->string('disclosures', 100)->nullable();
            $table->string('sqftsource', 100)->nullable();
            $table->string('exclusions', 100)->nullable();
            $table->string('builder_name', 100)->nullable();
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
        Schema::dropIfExists('property_additionals');
    }
};
