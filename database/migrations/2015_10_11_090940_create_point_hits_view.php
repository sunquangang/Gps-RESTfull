<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointHitsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement( 'CREATE VIEW point_hits_view AS SELECT count(id) AS hits, point_id FROM point_hits GROUP BY point_id ORDER BY hits DESC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement( 'DROP VIEW point_hits_view' );
    }
}
