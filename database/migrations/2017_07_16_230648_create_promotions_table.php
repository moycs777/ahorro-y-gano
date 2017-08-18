<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('promotions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->string('name');
            $table->text('description');
            $table->double('price_not_offert');
            $table->double('price_with_offert');
            $table->string('picture');
            $table->string('location');
            $table->date('expires');
            $table->integer('points');
            $table->integer('type');

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
        Schema::drop('promotions');
    }

}
