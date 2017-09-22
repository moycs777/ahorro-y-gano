<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration
{
    
    public function up()
    {
        
        Schema::create('stores', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('auth_id');
            $table->integer('admin_id');
            $table->string('name');
            $table->string('nif_cif');
            $table->integer('clasification_id');
            $table->string('address');
            $table->string('billing_address');
            $table->integer('state');
            $table->integer('city');
            $table->string('location');
            $table->string('zip');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('debt_level');
            $table->boolean('status');

            $table->timestamps();
            $table->softDeletes();
        });
            
    }

    public function down()
    {
        Schema::drop('stores');
    }

}
