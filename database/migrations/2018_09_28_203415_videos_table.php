<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->string('id')->primaryKey();
            $table->string('title');
            $table->string('white_pieces');
            $table->string('black_pieces');
            $table->string('opening');
            $table->string('event');
            $table->string('game_name');
            $table->longText('moves');

            $table->date('video_date');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
