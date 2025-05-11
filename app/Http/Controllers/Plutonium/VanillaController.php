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
        $data = $request->only([
            'guid',
            'name',
        ]);

        // Get the player who joined the server
        $player = User::where('guid', '=', $data['guid'])->get();

        // Player does not have an account
        if ($player->count() == 0)
        {
            // Add player to joins table for register
            $addJoin = Join::updateOrCreate([
                'guid' => $data['guid'],
            ],[
                'name' => $data['name'],
            ]);

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

        // Player has an account
        if ($player->count() > 0)
        {
            // Check if player has verified email
            if ($player[0]->email_verified_at == null) { $verified = 0; } else { $verified = 1; }

            // Return registered json data
            return response()->json([
                'account-guid' => $player[0]->guid,
                'account-name' => $player[0]->name,
                'account-display-name' => "[^{$player[0]->color}". self::levelType(config('plutonium.settings.level_type'), $player[0]->level) ."^7][^{$player[0]->color}". self::rankType(config('plutonium.settings.rank_type'), $player[0]->rank) ."^7] ^{$player[0]->color}{$player[0]->name}",
                'account-verified' => $verified,
                'account-rank' => $player[0]->rank,
                'account-level' => $player[0]->level,
                'account-banned' => $player[0]->banned,
                'account-color' => $player[0]->color,
                'account-welcome' => [
                    "-------------[ ^2Clipstone Zombies^7 ]-------------",
                    "Welcome to ^2Clipstone Zombies^7. Play fair and enjoy the servers",
                    "Please read the rules to be sure you're not breaking them",
                    "-------------[ ^2Clipstone Zombies^7 ]-------------",
                ]
            ]);
        }
    }

    public function leaderboards(Request $request)
    {
        // Get only the data we want from the request
        $data = $request->only([
            'map',
            'players',
            'players_count',
            'round',
        ]);
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
            'result' => "[^2ClipstoneZombies^7] The current games record has successfully been uploaded!",
        ]);
    }

    public function statistics(Request $request)
    {
        // Get only the data we want from the request
        $data = $request->only([
            'guid',
            'score',
        ]);

        // Get the player who joined the server
        $player = UsersStats::where('guid', '=', $data['guid'])->get();

        // Save stats sent from the server
        $saveStats = UsersStats::updateOrCreate([
            'guid' => $data['guid'],
        ],[
            'score' => $data['score'] + $player[0]->score,
            'kills' => $data['kills'] + $player[0]->kills,
            'downs' => $data['downs'] + $player[0]->downs,
            'deaths' => $data['deaths'] + $player[0]->deaths,
            'suicides' => $data['suicides'] + $player[0]->suicides,
            'revives' => $data['revives'] + $player[0]->revives,
            'headshots' => $data['headshots'] + $player[0]->headshots,
            'melee_kills' => $data['melee_kills'] + $player[0]->melee_kills,
            'grenade_kills' => $data['grenade_kills'] + $player[0]->grenade_kills,
            'total_shots' => $data['total_shots'] + $player[0]->total_shots,
            'hits' => $data['hits'] + $player[0]->hits,
            'sacrifices' => $data['sacrifices'] + $player[0]->sacrifices,
        ]);

        // Return success json result
        return response()->json([
            'result' => "[^2ClipstoneZombies^7] Your stats have been uploaded and saved!",
        ]);
    }

    public function autoMessages(Request $request)
    {
        // Get only the data we want from the request
        $data = $request->only([
            'map',
        ]);

        // Get a random number to determine what kind of message we want
        if (random_int(0, 1) == 0) {
            // Get the highest round record from the leaderboards table
            $random = random_int(1, 4);
            $record = Leaderboard::orderBy('round', 'desc')->where('map', $data['map'])->where('gamemode', 'Vanilla')->where('players_count', $random)->first();

            // Check if the record result is null
            if ($record == null) {
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
            'result' => config('plutonium.autoMessages.'.random_int(0, count(config('plutonium.autoMessages')) - 1)),
        ]);
    }
}
