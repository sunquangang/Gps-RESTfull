<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::dropIfExists('point_hits');
        Schema::create('point_hits', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('point_id')->unsigned()->index();
            $table->foreign('point_id')->references('id')->on('points');
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
        Schema::drop('point_hits');
    }
}
