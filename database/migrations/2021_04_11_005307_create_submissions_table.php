<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->string('sub_id');
            $table->string('company');
            $table->string('service_level');
            $table->string('status')->default('created');
            $table->integer('number_of_cards')->nullable();
            $table->boolean('needs_card_savers')->default(0);
            $table->double('grading_fee', 8, 2);
            $table->double('my_fee', 8, 2);
            $table->double('shipping_fee', 8, 2)->nullable();
            $table->double('card_saver_fee', 8, 2)->default(0);
            $table->boolean('paid')->default(0);
            $table->boolean('show_on_channel')->default(1);
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_date')->nullable();
            $table->timestamp('send_off_date')->nullable();
            $table->string('tracking_number')->nullable();
            $table->timestamp('accepted_terms_date')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
