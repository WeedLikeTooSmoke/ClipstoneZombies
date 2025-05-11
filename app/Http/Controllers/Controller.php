<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     *  --------------------------
     *  Plutonium Helper Functions
     *  --------------------------
     */
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
