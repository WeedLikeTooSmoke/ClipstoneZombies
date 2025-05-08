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
        Schema::create('users_stats', function (Blueprint $table) {
            $table->id();
            $table->integer('guid')->unique();
            $table->bigInteger('score')->default(0);
            $table->integer('rounds')->default(0);
            $table->integer('highestRound')->default(0);
            $table->bigInteger('kills')->default(0);
            $table->bigInteger('revives')->default(0);
            $table->bigInteger('downs')->default(0);
            $table->bigInteger('headshots')->default(0);
            $table->bigInteger('traveled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_stats');
    }
};
