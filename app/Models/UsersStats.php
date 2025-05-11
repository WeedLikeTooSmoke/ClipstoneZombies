<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersStats extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'guid',
        'name',
        'score',
        'kills',
        'downs',
        'deaths',
        'suicides',
        'revives',
        'headshots',
        'melee_kills',
        'grenade_kills',
        'total_shots',
        'hits',
        'sacrifices',
        'doors_purchased',
        'distance_traveled',
        'boards',
        'drops',
        'nuke_pickedup',
        'insta_kill_pickedup',
        'full_ammo_pickedup',
        'double_points_pickedup',
        'meat_stink_pickedup',
        'carpenter_pickedup',
        'fire_sale_pickedup',
        'zombie_blood_pickedup',
        'use_magicbox',
        'use_pap',
        'specialty_armorvest_drank',
        'specialty_quickrevive_drank',
        'specialty_rof_drank',
        'specialty_fastreload_drank',
        'specialty_flakjacket_drank',
        'specialty_additionalprimaryweapon_drank',
        'specialty_longersprint_drank',
        'specialty_deadshot_drank',
        'specialty_scavenger_drank',
        'specialty_finalstand_drank',
        'specialty_grenadepulldeath_drank',
        'specialty_nomotionsensor',
        'wallbuy_weapons_purchased',
        'ammo_purchased',
        'upgraded_ammo_purchased',
        'power_turnedon',
        'power_turnedoff',
        'planted_buildables_pickedup',
        'buildables_built',
        'time_played_total',
        'zdogs_killed',
        'zdog_rounds_finished',
        'zdog_rounds_lost',
        'killed_by_zdog',
        'screechers_killed',
        'screecher_teleporters_used',
        'avogadro_defeated',
        'killed_by_avogadro',
        'prison_brutus_killed',
        'buried_ghost_killed',
        'tomb_mechz_killed',
        'tomb_dig',
    ];
}
