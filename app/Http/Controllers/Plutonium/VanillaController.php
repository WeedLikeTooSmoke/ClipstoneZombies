<?php

namespace App\Http\Controllers\Plutonium;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Number;

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
            return response()->json([
                'account-guid' => 0,
                'account-name' => 0,
                'account-display-name' => 0,
                'account-verified' => 0,
                'account-rank' => 0,
                'account-level' => 0,
                'account-banned' => 0,
                'account-color' => 0,
            ]);
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

    public function leaderboards(Request $request)
    {
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

    public function statistics(Request $request)
    {
        // Get only the data we want from the request
        $data = $request->only([
            'guid',
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
        ]);

        // Get the player who joined the server
        $player = UsersStats::where('guid', $data['guid'])->first();

        // Save stats sent from the server
        $saveStats = UsersStats::updateOrCreate([
            'guid' => $data['guid'],
        ],[
            'score' => $data['score'] + $player->score,
            'kills' => $data['kills'] + $player->kills,
            'downs' => $data['downs'] + $player->downs,
            'deaths' => $data['deaths'] + $player->deaths,
            'suicides' => $data['suicides'] + $player->suicides,
            'revives' => $data['revives'] + $player->revives,
            'headshots' => $data['headshots'] + $player->headshots,
            'melee_kills' => $data['melee_kills'] + $player->melee_kills,
            'grenade_kills' => $data['grenade_kills'] + $player->grenade_kills,
            'total_shots' => $data['total_shots'] + $player->total_shots,
            'hits' => $data['hits'] + $player->hits,
            'sacrifices' => $data['sacrifices'] + $player->sacrifices,
        ]);

        // Return success json result
        return response()->json([
            'result' => "[^2ClipstoneZombies^7] Your stats have been uploaded and saved!",
        ]);
    }

    public function messages(Request $request)
    {
        // Get only the data we want from the request
        $data = $request->only(['map']);

        // Get a random number to determine what kind of message we want
        if (random_int(0, 1) === 0) {
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
}
