<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Number;

abstract class Controller
{
    /**
     *  --------------------------
     *  Plutonium Helper Functions
     *  --------------------------
     */
    public function returnInvalidRequestJson($type)
    {
        if ($type == "account")
        {
            return response()->json([
                'account-guid' => 0,
                'account-name' => 0,
                'account-display-name' => "0",
                'account-verified' => 0,
                'account-rank' => 0,
                'account-level' => 0,
                'account-banned' => 0,
                'account-color' => 0,
                'account-welcome' => [
                    "0",
                    "0",
                    "0",
                    "0",
                ]
            ]);
        }

        return response()->json([
            'result' => "[^2ClipstoneZombies^7] This request failed to be executed!",
        ]);
    }

    public function statsType($collection, $type)
    {
        $match = match ($type) {
            'kills' => 'statistics-details' => [
                            "-------------[ ^2Top Kill Statistics^7 ]-------------",
                            "[^2ClipstoneZombies^7]: 1st > ^2".$collection[0]->kills." kills by ".$collection[0]->name,
                            "[^2ClipstoneZombies^7]: 2nd > ^2".$collection[1]->kills." kills by ".$collection[1]->name,
                            "[^2ClipstoneZombies^7]: 3rd > ^2".$collection[2]->kills." kills by ".$collection[2]->name,
                            "[^2ClipstoneZombies^7]: 4th > ^2".$collection[3]->kills." kills by ".$collection[3]->name,
                            "[^2ClipstoneZombies^7]: 5th > ^2".$collection[4]->kills." kills by ".$collection[4]->name,
                            "-------------[ ^2Top Kill Statistics^7 ]-------------",
                        ],
            'revives' => 'statistics-details' => [
                            "-------------[ ^2Top Revive Statistics^7 ]-------------",
                            "[^2ClipstoneZombies^7]: 1st > ^2".$collection[0]->revives." kills by ".$collection[0]->name,
                            "[^2ClipstoneZombies^7]: 2nd > ^2".$collection[1]->revives." kills by ".$collection[1]->name,
                            "[^2ClipstoneZombies^7]: 3rd > ^2".$collection[2]->revives." kills by ".$collection[2]->name,
                            "[^2ClipstoneZombies^7]: 4th > ^2".$collection[3]->revives." kills by ".$collection[3]->name,
                            "[^2ClipstoneZombies^7]: 5th > ^2".$collection[4]->revives." kills by ".$collection[4]->name,
                            "-------------[ ^2Top Revive Statistics^7 ]-------------",
                        ],
            'downs' => 'statistics-details' => [
                            "-------------[ ^2Top Downs Statistics^7 ]-------------",
                            "[^2ClipstoneZombies^7]: 1st > ^2".$collection[0]->downs." kills by ".$collection[0]->name,
                            "[^2ClipstoneZombies^7]: 2nd > ^2".$collection[1]->downs." kills by ".$collection[1]->name,
                            "[^2ClipstoneZombies^7]: 3rd > ^2".$collection[2]->downs." kills by ".$collection[2]->name,
                            "[^2ClipstoneZombies^7]: 4th > ^2".$collection[3]->downs." kills by ".$collection[3]->name,
                            "[^2ClipstoneZombies^7]: 5th > ^2".$collection[4]->downs." kills by ".$collection[4]->name,
                            "-------------[ ^2Top Downs Statistics^7 ]-------------",
                        ],
            'deaths' => 'statistics-details' => [
                            "-------------[ ^2Top Death Statistics^7 ]-------------",
                            "[^2ClipstoneZombies^7]: 1st > ^2".$collection[0]->deaths." kills by ".$collection[0]->name,
                            "[^2ClipstoneZombies^7]: 2nd > ^2".$collection[1]->deaths." kills by ".$collection[1]->name,
                            "[^2ClipstoneZombies^7]: 3rd > ^2".$collection[2]->deaths." kills by ".$collection[2]->name,
                            "[^2ClipstoneZombies^7]: 4th > ^2".$collection[3]->deaths." kills by ".$collection[3]->name,
                            "[^2ClipstoneZombies^7]: 5th > ^2".$collection[4]->deaths." kills by ".$collection[4]->name,
                            "-------------[ ^2Top Death Statistics^7 ]-------------",
                        ],
            'headshots' => 'statistics-details' => [
                            "-------------[ ^2Top Headshot Statistics^7 ]-------------",
                            "[^2ClipstoneZombies^7]: 1st > ^2".$collection[0]->headshots." kills by ".$collection[0]->name,
                            "[^2ClipstoneZombies^7]: 2nd > ^2".$collection[1]->headshots." kills by ".$collection[1]->name,
                            "[^2ClipstoneZombies^7]: 3rd > ^2".$collection[2]->headshots." kills by ".$collection[2]->name,
                            "[^2ClipstoneZombies^7]: 4th > ^2".$collection[3]->headshots." kills by ".$collection[3]->name,
                            "[^2ClipstoneZombies^7]: 5th > ^2".$collection[4]->headshots." kills by ".$collection[4]->name,
                            "-------------[ ^2Top Headshot Statistics^7 ]-------------",
                        ],
        };

        return $match;
    }

    public function roundType($players)
    {
        $match = match ($players) {
            1 => 'Solo',
            2 => 'Duo',
            3 => 'Trio',
            4 => 'Quad',
            5 => 'Quintet',
            6 => 'Sextet',
            7 => 'Septet',
            8 => 'Octet',
            default => 'NaN'
        };

        // Return value matched from $match
        return $match;
    }

    public function levelType($type, $level)
    {
        // Check the type of levels
        if ($type == 1)
        {
            // Shortened level strings e.g 1000 = 1k
            return Number::abbreviate($level);
        }

        // Check the type of levels
        if ($type == 2)
        {
            // Roman numeral levels
            static $formatToRomanNumerals = new \NumberFormatter('@numbers=roman', \NumberFormatter::DECIMAL);
            return $formatToRomanNumerals->format($level);
        }

        // Return the type of levels wanted
        return $level;
    }

    public function rankType($type, $rank)
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
            default => 'NaN',
        };

        // Return the players rank
        return $match;
    }
}
