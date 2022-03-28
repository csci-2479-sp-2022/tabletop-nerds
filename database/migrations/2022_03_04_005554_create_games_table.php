<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id(); //
            $table->string('title');//
            $table->decimal('complexity_rating', 3, 2);//
            $table->decimal('cost', 5, 2);//
            $table->year('release_year');//
            $table->foreignId('publisher_id')->constrained(); //can't add it in the view.
            $table->integer('playing_time_minutes');//
            $table->integer('min_number_players');//
            $table->integer('max_number_players');//
            $table->text('description');//
            $table->text('img_url');//
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
};
