<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->integer('user_id');
            $table->string('status', 100)->nullable();
            $table->string('option_value', 100)->nullable();
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            //SETTING THE PRIMARY KEYS
            // $table->primary(['property_id']);
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
        Schema::dropIfExists('properties_options');
    }
}
