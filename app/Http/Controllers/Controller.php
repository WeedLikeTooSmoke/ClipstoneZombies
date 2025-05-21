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
        $match = ($type) {
            'account' => return response()->json([
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
            'getLeaderboards' => return response()->json([
               'result' => [
                    "[^2ClipstoneZombies^7] No available records to show at this time...",
                ]
            ]);
            'notStaff' =>  return response()->json([
                'result' => [
                    "[^2ClipstoneZombies^7] No available records to show at this time...",
                ]
            ]);
            default => return response()->json([
                'result' => "[^2ClipstoneZombies^7] This request failed to be executed...",
            ]);
        };

        // Return the matched response from the match method
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
