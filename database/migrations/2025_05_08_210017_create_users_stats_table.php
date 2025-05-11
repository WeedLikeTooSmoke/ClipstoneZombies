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
            $table->bigInteger('kills')->default(0);
            $table->bigInteger('downs')->default(0);
            $table->bigInteger('deaths')->default(0);
            $table->bigInteger('suicides')->default(0);
            $table->bigInteger('revives')->default(0);
            $table->bigInteger('headshots')->default(0);
            $table->bigInteger('melee_kills')->default(0);
            $table->bigInteger('grenade_kills')->default(0);
            $table->bigInteger('total_shots')->default(0);
            $table->bigInteger('hits')->default(0);
            $table->bigInteger('sacrifices')->default(0);
            $table->bigInteger('doors_purchased')->default(0);
            $table->bigInteger('distance_traveled')->default(0);
            $table->bigInteger('boards')->default(0);
            $table->bigInteger('drops')->default(0);
            $table->bigInteger('nuke_pickedup')->default(0);
            $table->bigInteger('insta_kill_pickedup')->default(0);
            $table->bigInteger('full_ammo_pickedup')->default(0);
            $table->bigInteger('double_points_pickedup')->default(0);
            $table->bigInteger('meat_stink_pickedup')->default(0);
            $table->bigInteger('carpenter_pickedup')->default(0);
            $table->bigInteger('fire_sale_pickedup')->default(0);
            $table->bigInteger('zombie_blood_pickedup')->default(0);
            $table->bigInteger('use_magicbox')->default(0);
            $table->bigInteger('use_pap')->default(0);
            $table->bigInteger('specialty_armorvest_drank')->default(0);
            $table->bigInteger('specialty_quickrevive_drank')->default(0);
            $table->bigInteger('specialty_rof_drank')->default(0);
            $table->bigInteger('specialty_fastreload_drank')->default(0);
            $table->bigInteger('specialty_flakjacket_drank')->default(0);
            $table->bigInteger('specialty_additionalprimaryweapon_drank')->default(0);
            $table->bigInteger('specialty_longersprint_drank')->default(0);
            $table->bigInteger('specialty_deadshot_drank')->default(0);
            $table->bigInteger('specialty_scavenger_drank')->default(0);
            $table->bigInteger('specialty_finalstand_drank')->default(0);
            $table->bigInteger('specialty_grenadepulldeath_drank')->default(0);
            $table->bigInteger('specialty_nomotionsensor')->default(0);
            $table->bigInteger('wallbuy_weapons_purchased')->default(0);
            $table->bigInteger('ammo_purchased')->default(0);
            $table->bigInteger('upgraded_ammo_purchased')->default(0);
            $table->bigInteger('power_turnedon')->default(0);
            $table->bigInteger('power_turnedoff')->default(0);
            $table->bigInteger('planted_buildables_pickedup')->default(0);
            $table->bigInteger('buildables_built')->default(0);
            $table->bigInteger('time_played_total')->default(0);
            $table->bigInteger('zdogs_killed')->default(0);
            $table->bigInteger('zdog_rounds_finished')->default(0);
            $table->bigInteger('zdog_rounds_lost')->default(0);
            $table->bigInteger('killed_by_zdog')->default(0);
            $table->bigInteger('screechers_killed')->default(0);
            $table->bigInteger('screecher_teleporters_used')->default(0);
            $table->bigInteger('avogadro_defeated')->default(0);
            $table->bigInteger('killed_by_avogadro')->default(0);
            $table->bigInteger('prison_brutus_killed')->default(0);
            $table->bigInteger('buried_ghost_killed')->default(0);
            $table->bigInteger('tomb_mechz_killed')->default(0);
            $table->bigInteger('tomb_dig')->default(0);
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
