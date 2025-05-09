<?php

namespace App\Http\Controllers\Plutonium;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Plutonium\ApiController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Number;

use App\Models\User;

class VanillaController extends Controller
{
    public function account(Request $request)
    {
        $data = $request->only([
            'guid',
            'name',
        ]);

        $player = User::where('guid', '=', '3390756')->get();

        if ($player->count() == 0)
        {
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

        if ($player->count() > 0)
        {
            if ($player[0]->email_verified_at == null) { $verified = 0; } else { $verified = 1; }

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
                    "-------------[ ^5Clipstone Zombies^7 ]-------------",
                    "Welcome to Clipstone Zombies. Play fair and enjoy the servers",
                    "Please read the rules to be sure you're not breaking them",
                    "-------------[ ^5Clipstone Zombies^7 ]-------------",
                ]
            ]);
        }
    }

    public function levelType($type, $level)
    {
        if ($type == 1)
        {
            return Number::abbreviate($level);
        }

        if ($type == 2)
        {
            static $formatToRomanNumerals = new \NumberFormatter('@numbers=roman', \NumberFormatter::DECIMAL);
            return $formatToRomanNumerals->format($level);
        }

        return $level;
    }

    public function rankType($type, $rank)
    {
        if ($type == 1)
        {
            $match = match ($rank)
            {
                0 => 'USER',
                1 => 'VIP',
                2 => 'VIP+',
                3 => 'VIP++',
                4 => 'VIP+++',
                5 => 'MOD',
                6 => 'ADMIN',
                7 => 'OWNER',
            };

            return $match;
        }

        if ($type == 2)
        {
            static $formatToRomanNumerals = new \NumberFormatter('@numbers=roman', \NumberFormatter::DECIMAL);
            return $formatToRomanNumerals->format($rank);
        }

        return $level;
    }
}
