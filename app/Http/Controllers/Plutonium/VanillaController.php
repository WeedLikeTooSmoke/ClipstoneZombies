<?php

namespace App\Http\Controllers\Plutonium;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Number;
use Illuminate\Support\Carbon;

use App\Models\User;
use App\Models\Join;
use App\Models\Leaderboard;
use App\Models\UsersStats;

class VanillaController extends Controller
{
    /**
     * Game Functions
     */
    public function account(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('account');
        }

        // Get only the data we want from the request
        $data = $request->only(['guid', 'name']);

        // Get the player who joined the server
        $player = User::where('guid', $data['guid'])->first();

        // Player does not have an account
        if (!$player)
        {
            // Add player to joins table for register
            $addJoin = Join::updateOrCreate(['guid' => $data['guid']],['name' => $data['name']]);

            // Return not registered json data
            return self::returnInvalidRequestJson('account');
        }

        // Check if player has verified email
        if ($player->email_verified_at == null) { $verified = 0; } else { $verified = 1; }

        // Return registered json data
        return response()->json([
            'account-guid' => $player->guid,
            'account-name' => $player->name,
            'account-display-name' => "[^{$player->color}". self::levelType(config('plutonium.settings.level_type'), $player->level) ."^7][^{$player->color}". self::rankType(config('plutonium.settings.rank_type'), $player->rank) ."^7] ^{$player->color}{$player->name}",
            'account-verified' => $verified,
            'account-rank' => $player->rank,
            'account-level' => $player->level,
            'account-banned' => $player->banned,
            'account-color' => $player->color,
            'account-welcome' => [
                "-------------[ ^2Clipstone Zombies^7 ]-------------",
                "Welcome to ^2Clipstone Zombies^7. Play fair and enjoy the servers",
                "Please read the rules to be sure you're not breaking them",
                "-------------[ ^2Clipstone Zombies^7 ]-------------",
            ]
        ]);
    }

    public function getAccount(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('account');
        }

        // Get only the data we want from the request
        $data = $request->only(['guid', 'name']);

        // Get the player who joined the server
        $player = User::where('guid', $data['guid'])->first();
        $stats = UsersStats::where('guid', $data['guid'])->first();

        // Player does not have an account
        if (!$player)
        {
            // Return not registered json data
            return self::returnInvalidRequestJson('getAccount');
        }

        // Return players data
        return response()->json([
            'account-details' => [
                "-------------[ ^2Account^7 ]-------------",
                "[^2ClipstoneZombies^7]: Level > ^2".self::levelType(config('plutonium.settings.level_type'), $player->level),
                "[^2ClipstoneZombies^7]: Rank > ^2".self::rankType(config('plutonium.settings.rank_type'), $player->rank),
                "[^2ClipstoneZombies^7]: Bank > ^2$".number_format($stats->score),
                "[^2ClipstoneZombies^7]: Joined > ^2".$player->created_at->diffForHumans(),
                "-------------[ ^2Account^7 ]-------------",
            ]
        ]);
    }

    public function leaderboards(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('leaderboards');
        }

        // Get only the data we want from the request
        $data = $request->only(['map', 'players', 'players_count', 'round']);
        $data["gamemode"] = "Vanilla";

        // Create player('s') record in the leaderboards table
        Leaderboard::Create([
            'map' => $data["map"],
            'players' => $data["players"],
            'players_count' => $data["players_count"],
            'round' => $data["round"],
            'gamemode' => $data["gamemode"],
        ]);

        // Return success json result
        return response()->json([
            'result' => "[^2ClipstoneZombies^7] Your record has been uploaded and saved!",
        ]);
    }

    public function getLeaderboards(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('getLeaderboards');
        }

        // Get only the data we want from the request
        $data = $request->only(['map']);

        // Get the top 5 records from the leaderboards table
        $records = Leaderboard::orderBy('round', 'desc')->where('map', $data['map'])->where('gamemode', 'Vanilla')->take(5)->get();

        if (count($records) < 5)
        {
            return self::returnInvalidRequestJson('getLeaderboards');
        }

        // Return leaderboards data
        return response()->json([
            'leaderboards-details' => [
                "-------------[ ^2".ucfirst($data['map'])." Records^7 ]-------------",
                "[^2ClipstoneZombies^7]: 1st > ^2". $records[0]->round."^7 by ^2".$records[0]->players,
                "[^2ClipstoneZombies^7]: 2nd > ^2". $records[1]->round."^7 by ^2".$records[1]->players,
                "[^2ClipstoneZombies^7]: 3rd > ^2". $records[2]->round."^7 by ^2".$records[2]->players,
                "[^2ClipstoneZombies^7]: 4th > ^2". $records[3]->round."^7 by ^2".$records[3]->players,
                "[^2ClipstoneZombies^7]: 5th > ^2". $records[4]->round."^7 by ^2".$records[4]->players,
                "-------------[ ^2".ucfirst($data['map'])." Records^7 ]-------------",
            ]
        ]);
    }

    public function statistics(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('statistics');
        }

        // Get only the data we want from the request
        $data = $request->only([
            'guid', 'score', 'kills', 'downs', 'deaths', 'suicides', 'revives', 'headshots',
            'melee_kills', 'grenade_kills', 'total_shots', 'hits', 'sacrifices', 'doors_purchased',
            'distance_traveled', 'boards', 'drops', 'nuke_pickedup', 'insta_kill_pickedup', 'full_ammo_pickedup',
            'double_points_pickedup', 'meat_stink_pickedup', 'carpenter_pickedup', 'fire_sale_pickedup', 'zombie_blood_pickedup',
            'use_magicbox', 'use_pap', 'specialty_armorvest_drank', 'specialty_quickrevive_drank', 'specialty_rof_drank',
            'specialty_fastreload_drank', 'specialty_flakjacket_drank', 'specialty_additionalprimaryweapon_drank', 'specialty_longersprint_drank',
            'specialty_deadshot_drank', 'specialty_scavenger_drank', 'specialty_finalstand_drank', 'specialty_grenadepulldeath_drank',
            'specialty_nomotionsensor', 'wallbuy_weapons_purchased', 'ammo_purchased', 'upgraded_ammo_purchased', 'power_turnedon',
            'power_turnedoff', 'planted_buildables_pickedup', 'buildables_built', 'time_played_total', 'zdogs_killed', 'zdog_rounds_finished',
            'zdog_rounds_lost', 'killed_by_zdog', 'screechers_killed', 'screecher_teleporters_used', 'avogadro_defeated', 'killed_by_avogadro',
            'prison_brutus_killed', 'buried_ghost_killed', 'tomb_mechz_killed', 'tomb_dig',
        ]);

        // Get the player who joined the server
        $player = UsersStats::where('guid', $data['guid'])->first();

        // Save stats sent from the server
        $saveStats = UsersStats::updateOrCreate([
            'guid' => $data['guid'],
        ],[
            'score' => $data['score'] + $player->score, 'kills' => $data['kills'] + $player->kills,
            'downs' => $data['downs'] + $player->downs, 'deaths' => $data['deaths'] + $player->deaths,
            'suicides' => $data['suicides'] + $player->suicides, 'revives' => $data['revives'] + $player->revives,
            'headshots' => $data['headshots'] + $player->headshots, 'melee_kills' => $data['melee_kills'] + $player->melee_kills,
            'grenade_kills' => $data['grenade_kills'] + $player->grenade_kills, 'total_shots' => $data['total_shots'] + $player->total_shots,
            'hits' => $data['hits'] + $player->hits, 'sacrifices' => $data['sacrifices'] + $player->sacrifices,
            'doors_purchased' => $data['doors_purchased'] + $player->doors_purchased, 'distance_traveled' => $data['distance_traveled'] + $player->distance_traveled,
            'boards' => $data['boards'] + $player->boards, 'drops' => $data['drops'] + $player->drops,
            'nuke_pickedup' => $data['nuke_pickedup'] + $player->nuke_pickedup, 'insta_kill_pickedup' => $data['insta_kill_pickedup'] + $player->insta_kill_pickedup,
            'full_ammo_pickedup' => $data['full_ammo_pickedup'] + $player->full_ammo_pickedup, 'double_points_pickedup' => $data['double_points_pickedup'] + $player->double_points_pickedup,
            'meat_stink_pickedup' => $data['meat_stink_pickedup'] + $player->meat_stink_pickedup, 'carpenter_pickedup' => $data['carpenter_pickedup'] + $player->carpenter_pickedup,
            'fire_sale_pickedup' => $data['fire_sale_pickedup'] + $player->fire_sale_pickedup, 'zombie_blood_pickedup' => $data['zombie_blood_pickedup'] + $player->zombie_blood_pickedup,
            'use_magicbox' => $data['use_magicbox'] + $player->use_magicbox, 'use_pap' => $data['use_pap'] + $player->use_pap,
            'specialty_armorvest_drank' => $data['specialty_armorvest_drank'] + $player->specialty_armorvest_drank, 'specialty_quickrevive_drank' => $data['specialty_quickrevive_drank'] + $player->specialty_quickrevive_drank,
            'specialty_rof_drank' => $data['specialty_rof_drank'] + $player->specialty_rof_drank, 'specialty_fastreload_drank' => $data['specialty_fastreload_drank'] + $player->specialty_fastreload_drank,
            'specialty_flakjacket_drank' => $data['specialty_flakjacket_drank'] + $player->specialty_flakjacket_drank, 'specialty_additionalprimaryweapon_drank' => $data['specialty_additionalprimaryweapon_drank'] + $player->specialty_additionalprimaryweapon_drank,
            'specialty_longersprint_drank' => $data['specialty_longersprint_drank'] + $player->specialty_longersprint_drank, 'specialty_deadshot_drank' => $data['specialty_deadshot_drank'] + $player->specialty_deadshot_drank,
            'specialty_scavenger_drank' => $data['specialty_scavenger_drank'] + $player->specialty_scavenger_drank, 'specialty_finalstand_drank' => $data['specialty_finalstand_drank'] + $player->specialty_finalstand_drank,
            'specialty_grenadepulldeath_drank' => $data['specialty_grenadepulldeath_drank'] + $player->specialty_grenadepulldeath_drank, 'specialty_nomotionsensor' => $data['specialty_nomotionsensor'] ?? 0 + $player->specialty_nomotionsensor,
            'wallbuy_weapons_purchased' => $data['wallbuy_weapons_purchased'] + $player->wallbuy_weapons_purchased, 'ammo_purchased' => $data['ammo_purchased'] + $player->ammo_purchased,
            'upgraded_ammo_purchased' => $data['upgraded_ammo_purchased'] + $player->upgraded_ammo_purchased, 'power_turnedon' => $data['power_turnedon'] + $player->power_turnedon, 'power_turnedoff' => $data['power_turnedoff'] + $player->power_turnedoff,
            'planted_buildables_pickedup' => $data['planted_buildables_pickedup'] + $player->planted_buildables_pickedup, 'buildables_built' => $data['buildables_built'] + $player->buildables_built,
            'time_played_total' => $data['time_played_total'] + $player->time_played_total, 'zdogs_killed' => $data['zdogs_killed'] + $player->zdogs_killed,
            'zdog_rounds_finished' => $data['zdog_rounds_finished'] + $player->zdog_rounds_finished, 'zdog_rounds_lost' => $data['zdog_rounds_lost'] + $player->zdog_rounds_lost,
            'killed_by_zdog' => $data['killed_by_zdog'] + $player->killed_by_zdog, 'screechers_killed' => $data['screechers_killed'] + $player->screechers_killed,
            'screecher_teleporters_used' => $data['screecher_teleporters_used'] + $player->screecher_teleporters_used, 'avogadro_defeated' => $data['avogadro_defeated'] + $player->avogadro_defeated,
            'prison_brutus_killed' => $data['prison_brutus_killed'] + $player->prison_brutus_killed, 'buried_ghost_killed' => $data['buried_ghost_killed'] + $player->buried_ghost_killed,
            'tomb_mechz_killed' => $data['tomb_mechz_killed'] + $player->tomb_mechz_killed, 'tomb_dig' => $data['tomb_dig'] + $player->tomb_dig,
        ]);

        // Return success json result
        return response()->json([
            'result' => "[^2ClipstoneZombies^7] Your stats have been uploaded and saved!",
        ]);
    }

    public function getStatistics(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('getStatistics');
        }

        // Get only the data we want from the request
        $data = $request->only(['guid']);

        // Get the player who executed the command
        $player = UsersStats::where('guid', $data['guid'])->first();

        // Return players statistics
        return response()->json([
            'statistics-details' => [
                "-------------[ ^2My Statistics^7 ]-------------",
                "[^2ClipstoneZombies^7]: Kills > ^2".number_format($player->kills),
                "[^2ClipstoneZombies^7]: Downs > ^2".number_format($player->downs),
                "[^2ClipstoneZombies^7]: Deaths > ^2".number_format($player->deaths),
                "[^2ClipstoneZombies^7]: Revives > ^2".number_format($player->revives),
                "[^2ClipstoneZombies^7]: Headshots > ^2".number_format($player->headshots),
                "-------------[ ^2My Statistics^7 ]-------------",
            ]
        ]);
    }

    public function getTopStatistics(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('getStatistics');
        }

        // Get only the data we want from the request
        $data = $request->only(['stats_type']);

        // Get the top statistics from the given statistics type
        $stats = UsersStats::orderBy($data['stats_type'], 'desc')->limit(5)->get();

        // Match the statistic from the given statistics type
        $match = match ($data['stats_type'])
        {
            'kills' => response()->json([
                'topstatistics-details' => [
                    "-------------[ ^2Top Statistics^7 ]-------------",
                    "[^2ClipstoneZombies^7]: 1st > ^2".number_format($stats[0]->kills)." Kills by ".$stats[0]->name,
                    "[^2ClipstoneZombies^7]: 2nd > ^2".number_format($stats[1]->kills)." Kills by ".$stats[1]->name,
                    "[^2ClipstoneZombies^7]: 3rd > ^2".number_format($stats[2]->kills)." Kills by ".$stats[2]->name,
                    "[^2ClipstoneZombies^7]: 4th > ^2".number_format($stats[3]->kills)." Kills by ".$stats[3]->name,
                    "[^2ClipstoneZombies^7]: 5th > ^2".number_format($stats[4]->kills)." Kills by ".$stats[4]->name,
                    "-------------[ ^2Top Statistics^7 ]-------------",
                ]
            ]),
            'downs' => response()->json([
                'topstatistics-details' => [
                    "-------------[ ^2Top Statistics^7 ]-------------",
                    "[^2ClipstoneZombies^7]: 1st > ^2".number_format($stats[0]->downs)." Downs by ".$stats[0]->name,
                    "[^2ClipstoneZombies^7]: 2nd > ^2".number_format($stats[1]->downs)." Downs by ".$stats[1]->name,
                    "[^2ClipstoneZombies^7]: 3rd > ^2".number_format($stats[2]->downs)." Downs by ".$stats[2]->name,
                    "[^2ClipstoneZombies^7]: 4th > ^2".number_format($stats[3]->downs)." Downs by ".$stats[3]->name,
                    "[^2ClipstoneZombies^7]: 5th > ^2".number_format($stats[4]->downs)." Downs by ".$stats[4]->name,
                    "-------------[ ^2Top Statistics^7 ]-------------",
                ]
            ]),
            'deaths' => response()->json([
                'topstatistics-details' => [
                    "-------------[ ^2Top Statistics^7 ]-------------",
                    "[^2ClipstoneZombies^7]: 1st > ^2".number_format($stats[0]->deaths)." Deaths by ".$stats[0]->name,
                    "[^2ClipstoneZombies^7]: 2nd > ^2".number_format($stats[1]->deaths)." Deaths by ".$stats[1]->name,
                    "[^2ClipstoneZombies^7]: 3rd > ^2".number_format($stats[2]->deaths)." Deaths by ".$stats[2]->name,
                    "[^2ClipstoneZombies^7]: 4th > ^2".number_format($stats[3]->deaths)." Deaths by ".$stats[3]->name,
                    "[^2ClipstoneZombies^7]: 5th > ^2".number_format($stats[4]->deaths)." Deaths by ".$stats[4]->name,
                    "-------------[ ^2Top Statistics^7 ]-------------",
                ]
            ]),
            'revives' => response()->json([
                'topstatistics-details' => [
                    "-------------[ ^2Top Statistics^7 ]-------------",
                    "[^2ClipstoneZombies^7]: 1st > ^2".number_format($stats[0]->revives)." Revives by ".$stats[0]->name,
                    "[^2ClipstoneZombies^7]: 2nd > ^2".number_format($stats[1]->revives)." Revives by ".$stats[1]->name,
                    "[^2ClipstoneZombies^7]: 3rd > ^2".number_format($stats[2]->revives)." Revives by ".$stats[2]->name,
                    "[^2ClipstoneZombies^7]: 4th > ^2".number_format($stats[3]->revives)." Revives by ".$stats[3]->name,
                    "[^2ClipstoneZombies^7]: 5th > ^2".number_format($stats[4]->revives)." Revives by ".$stats[4]->name,
                    "-------------[ ^2Top Statistics^7 ]-------------",
                ]
            ]),
            'score' => response()->json([
                'topstatistics-details' => [
                    "-------------[ ^2Top Statistics^7 ]-------------",
                    "[^2ClipstoneZombies^7]: 1st > ^2£".number_format($stats[0]->score)." Money by ".$stats[0]->name,
                    "[^2ClipstoneZombies^7]: 2nd > ^2£".number_format($stats[1]->score)." Money by ".$stats[1]->name,
                    "[^2ClipstoneZombies^7]: 3rd > ^2£".number_format($stats[2]->score)." Money by ".$stats[2]->name,
                    "[^2ClipstoneZombies^7]: 4th > ^2£".number_format($stats[3]->score)." Money by ".$stats[3]->name,
                    "[^2ClipstoneZombies^7]: 5th > ^2£".number_format($stats[4]->score)." Money by ".$stats[4]->name,
                    "-------------[ ^2Top Statistics^7 ]-------------",
                ]
            ]),
        };

        // Return the statistics matched from the match method
        return $match;
    }

    public function messages(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('messages');
        }

        // Get only the data we want from the request
        $data = $request->only(['map']);

        // Get a random number to determine what kind of message we want
        if (random_int(0, 2) === 0) {
            // Get the highest round record from the leaderboards table
            $random = random_int(1, 4);
            $record = Leaderboard::orderBy('round', 'desc')->where('map', $data['map'])->where('gamemode', 'Vanilla')->where('players_count', $random)->first();

            // Check if the record result is null
            if (!$record) {
                // Return highest round record json
                return response()->json([
                    'result' => "[^2ClipstoneZombies^7]: ".ucfirst($data['map'])." ".self::roundType($random)." Record > ^2This record has not yet been set...",
                ]);
            }

            // Return highest round record json
            return response()->json([
                'result' => "[^2ClipstoneZombies^7]: ".ucfirst($data['map'])." ".self::roundType($record['players_count'])." Record > ^2Round ".$record['round']." By ".$record['players'],
            ]);
        }

        // Return random message from config
        return response()->json([
            'result' => config('plutonium.messages.'.random_int(0, count(config('plutonium.messages')) - 1)),
        ]);
    }

    public function rules(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('rules');
        }

        // Return Rules for the players
        return response()->json([
            'rules-details' => [
                "-------------[ ^2Clipstone Rules^7 ]-------------",
                "[^2ClipstoneZombies^7]: Don't be a meanie",
                "[^2ClipstoneZombies^7]: Don't say slurs",
                "[^2ClipstoneZombies^7]: Don't block players",
                "[^2ClipstoneZombies^7]: Don't hold rounds",
                "[^2ClipstoneZombies^7]: Don't glitch, hack or cheat",
                "-------------[ ^2Clipstone Rules^7 ]-------------",
            ]
        ]);
    }

    public function help(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('rules');
        }

        // Get only the data we want from the request
        // $data = $request->only(['page']);

        // Return Rules for the players
        return response()->json([
            'help-details' => [
                "---------[ ^2Clipstone Help Page 1^7 ]---------",
                "[^2ClipstoneZombies^7]: .account > Show your account details",
                "[^2ClipstoneZombies^7]: .leaderboard > Show top 5 leaderboard records",
                "[^2ClipstoneZombies^7]: .rules > Show all Clipstone Zombies rules",
                "[^2ClipstoneZombies^7]: .stats > Show all of your statistics",
                "---------[ ^2Clipstone Help Page 1^7 ]---------",
            ]
        ]);
    }

    public function banPlayer(Request $request)
    {
        // Check if the request is valid
        if ($request->header('Api-Key') !== config('plutonium.api.key') || $request->header('Api-Agent') !== config('plutonium.api.agent'))
        {
            return self::returnInvalidRequestJson('banPlayer');
        }

        // Get only the requested data from the request
        $data = $request->only(['staff_guid', 'player_name']);

        // Get the users data making the request
        $staff = User::where('guid', $data['staff_guid'])->first();

        // Check if the user making the request is a high enough rank
        if ($staff->rank <= 5)
        {
            return self::returnInvalidRequestJson('banPlayer');
        }

        // Set the player being banned to be banned
        $player = User::where('name', 'like', '%'.$data['player_name'].'%')->update(['banned' => 1]);

        return response()->json([
            'ban-details' => [
                "---------[ ^2Clipstone Ban^7 ]---------",
                "[^2ClipstoneZombies^7]: ".$data['player_name']." has been banned",
                "---------[ ^2Clipstone Ban^7 ]---------",
            ]
        ]);
    }
}
