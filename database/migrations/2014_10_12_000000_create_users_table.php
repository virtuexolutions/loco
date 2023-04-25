<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address', 80)->nullable();
            $table->string('lng', 100)->nullable();
            $table->string('ltd', 100)->nullable();
            $table->string('radius', 100)->nullable();
            $table->string('phone')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('state', 80)->nullable();
            $table->string('zipcode', 80)->nullable();
            $table->string('country_code', 80)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('how_get_there', 255)->nullable()->comment('1=Walk,2=Bike,3=Drive');
            $table->string('type_of_building', 255)->nullable()->comment('1 = High Rise , 2 = Mid Rise , 3 = Garden Style');
            $table->boolean('is_evicted')->nullable()->comment('1=yes,2=no');
            $table->string('price_range', 150)->nullable();
            $table->text('learn_more_about')->nullable();
            $table->string('map_radius',255)->nullable();
            $table->text('features_amenities')->nullable()->comment('1=Balcony,2=Pool,3=Gym,4=Conclerge,5=Hot tub at pool,6=Hard wook floor,7=Residents media room,8=Heated pool,9=Rooftop pool,10=Valet parking,11=Dry cleaning,12=Pet spa,13=VR golf,14=Downtown view');
            $table->string('monthly_income',255)->nullable();
            $table->string('care_most_about', 255)->nullable()->conmment("1= Best Blend of price or location & features,2= Best Location,3 = Most of my features,4= Best Location");
            $table->string('bathroom_features', 255)->nullable()->comment('1=Hard wook floor,2=Residents media room,3=Heated pool');
            $table->string('move_date', 255)->nullable();
            $table->text('moving_destinations')->nullable();
            $table->string('pets', 255)->nullable()->comment('1=Dog,2=Cat');
            $table->string('looking_lease_leght', 255)->nullable();
            $table->string('no_of_bedroom', 255)->nullable()->comment('1 = Studio , 2 = 1 Bed , 3 = 2+den , 4 = 2 Bed , 5 = 2+Den , 6 = 3 Bed');
            $table->string('flexible_move_time', 255)->nullable()->comment('1 = within 1 week , 2 = within 2 weeks , 3 = between 2 weeks and a month , 4 = No Rush'); 
            $table->integer('user_type')->unsigned()->nullable()->default(1)->comment('1=buyer,2=saler');
            $table->string('email_verified_at')->nullable();
            $table->string('password', 80);
            $table->boolean('active')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
