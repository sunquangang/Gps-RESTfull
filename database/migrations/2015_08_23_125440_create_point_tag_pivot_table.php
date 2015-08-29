<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointTagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_tag', function(Blueprint $table) {
          $table->increments('id');
            $table->integer('point_id')->unsigned()->index();
            $table->foreign('point_id')->references('id')->on('points');
            $table->integer('tags_id')->unsigned()->index();
            $table->foreign('tags_id')->references('id')->on('tags');
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
        Schema::drop('point_tags');
    }
}
