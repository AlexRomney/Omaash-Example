<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->boolean('auction_off')->default(0)->after('expedited');
            $table->string('auction_company')->after('auction_off')->nullable();
            $table->decimal('sold_amount', 6, 2)->after('auction_company')->nullable();
            $table->decimal('payout', 6, 2)->after('sold_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('auction_off');
            $table->dropColumn('auction_company');
            $table->dropColumn('sold_amount');
            $table->dropColumn('payout');
        });
    }
};
