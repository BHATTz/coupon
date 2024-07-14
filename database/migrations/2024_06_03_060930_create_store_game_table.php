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
        Schema::create('store_game', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_id');
            $table->string('user_id');
            $table->string('game_number');
            $table->string('game_code');
            $table->string('count')->defualt('1');
            $table->string('date');
            $table->string('pay_order_id');
            $table->string('payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_game');
    }
};
