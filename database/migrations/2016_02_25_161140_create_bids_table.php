<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
        
      $table->increments('id');
      $table->integer('user_id');
      $table->integer('order_id')->nullable();
      $table->integer('product_id');
      $table->integer('complete')->default(0);
      $table->dateTime('expiration');
      $table->decimal('amount', 8, 2);
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
        Schema::drop('bids');
    }
}
