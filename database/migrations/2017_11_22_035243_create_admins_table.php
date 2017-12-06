<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('builder', function (Blueprint $table) {
            $table->increments('builder_id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('business_name');
            $table->string('phone');
            $table->rememberToken();
            $table->timestamps();
            $table->string('ad_unit');
            $table->string('ad_number');
            $table->string('ad_street');
            $table->string('ad_city');
            $table->string('ad_state');
            $table->string('ad_zip');
            $table->string('ad_country');
            $table->string('ip_address');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
