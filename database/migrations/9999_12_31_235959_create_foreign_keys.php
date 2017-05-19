<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('keyword_video', function(Blueprint $table) {

            $table
                    ->foreign('keyword_id')
                    ->references('id')
                    ->on('keywords')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table
                    ->foreign('video_id')
                    ->references('id')
                    ->on('videos')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        Schema::table('videos', function(Blueprint $table) {

            $table
                    ->foreign('location_id')
                    ->references('id')
                    ->on('locations')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('videos', function($table) {
            $table->dropForeign('videos_location_id_foreign');
        });
        Schema::table('keyword_video', function($table) {
            $table->dropForeign('keyword_video_keyword_id_foreign');
            $table->dropForeign('keyword_video_video_id_foreign');
        });
    }

}
