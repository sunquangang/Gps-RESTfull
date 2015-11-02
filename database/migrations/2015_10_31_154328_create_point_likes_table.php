<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_likes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('point_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->foreign('point_id')->references('id')->on('points');
          $table->foreign('user_id')->references('id')->on('users');
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
        //
        Schema::drop('point_likes');
    }
}
