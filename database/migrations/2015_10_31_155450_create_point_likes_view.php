<?php

use Illuminate\Database\Migrations\Migration;

class CreatePointLikesView extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::statement('
            CREATE VIEW point_likes_view AS SELECT count(id) AS likes, point_id FROM point_likes GROUP BY point_id ORDER BY likes DESC');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        //
        DB::statement( 'DROP VIEW point_likes_view' );
    }
}
