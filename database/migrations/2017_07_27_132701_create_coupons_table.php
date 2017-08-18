<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('coupons', function(Blueprint $table) {
                $table->increments('id');
                $table->integer('store_id');
                $table->integer('promotion_id');
                $table->integer('user_id');
                $table->boolean('consolidated');
                $table->boolean('payed');
                $table->boolean('invoice')->nullable();
                $table->integer('points');
                $table->date('payed_at')->nullable();

                $table->timestamps();
                $table->softDeletes();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }

}
