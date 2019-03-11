<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('stadium_id');
            $table->foreign('stadium_id')->references('id')->on('stadiums');
            $table->string('game_title');
            $table->text('description');
            $table->double('price_per_person');
            $table->date('date');
            $table->time('time');
            $table->enum('duration', ['45 min', '1 hour', '1h and 30 min', '2 hours']);
            $table->enum('players_number_per_team', ['2X2', '3X3', '4X4', '5X5', '6X6', '7X7', '8X8']);
            $table->integer('total_players_number');
            $table->boolean('is_weekly')->default(false);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_joinable')->default(false);
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
        Schema::dropIfExists('games');
    }
}
