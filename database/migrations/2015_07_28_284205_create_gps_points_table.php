<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGpsPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('points');
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            
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
        //
    }
}
