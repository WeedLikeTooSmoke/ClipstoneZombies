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
            $table->bigInteger('highest_score')->default(0);
            $table->bigInteger('rounds')->default(0);
            $table->integer('highest_round')->default(0);
            $table->bigInteger('kills')->default(0);
            $table->integer('highest_kills')->default(0);
            $table->bigInteger('revives')->default(0);
            $table->integer('highest_revives')->default(0);
            $table->bigInteger('downs')->default(0);
            $table->integer('highest_downs')->default(0);
            $table->bigInteger('headshots')->default(0);
            $table->integer('highest_headshots')->default(0);
            $table->bigInteger('traveled')->default(0);
            $table->integer('highest_traveled')->default(0);
            $table->bigInteger('bosses_killed')->default(0);
            $table->integer('highest_bosses_killed')->default(0);
            $table->bigInteger('missions_completed')->default(0);
            $table->integer('highest_missions_completed')->default(0);
            $table->bigInteger('money_gambled')->default(0);
            $table->integer('highest_money_gambled')->default(0);
            $table->integer('highest_money_won')->default(0);
            $table->integer('distance_traveled')->default(0);
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
