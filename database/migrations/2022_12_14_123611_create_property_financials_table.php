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
        Schema::create('property_financials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')->unsigned();
            $table->string('maintenance_fee_amount', 100)->nullable();
            $table->string('hoa_mandatory', 100)->nullable();
            $table->string('tax_rate', 100)->nullable();
            $table->string('finance_available', 100)->nullable();
            $table->string('tax_amount', 100)->nullable();
            $table->string('fee_other_amount', 100)->nullable();
            $table->string('compensation_buyer_agent', 100)->nullable();
            $table->string('other_mandatory_fee', 100)->nullable();
            $table->string('tax_year', 100)->nullable();
            $table->string('ownership', 100)->nullable();
            $table->string('water_sewer', 100)->nullable();
            $table->string('fee_other', 100)->nullable();
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
        Schema::dropIfExists('property_financials');
    }
};
