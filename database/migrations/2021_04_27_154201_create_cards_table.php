<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('set_id');
            $table->foreign('set_id')
                ->references('id')
                ->on('sets');
            $table->string('set_name')->nullable();
            $table->string('card_id');
            $table->string('name');
            $table->string('number');
            $table->text('types')->nullable();
            $table->string('artist')->nullable();
            $table->string('rarity')->nullable();
            $table->string('image_small');
            $table->string('image_large');
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
        Schema::dropIfExists('cards');
    }
}
