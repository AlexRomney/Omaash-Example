<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->string('set_id');
            $table->string('series');
            $table->string('name');
            $table->string('release_date');
            $table->string('release_year');
            $table->string('set_total');
            $table->string('secret_rares')->default(0);
            $table->string('card_total');
            $table->string('image_symbol');
            $table->string('image_logo'); 
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
        Schema::dropIfExists('sets');
    }
}
