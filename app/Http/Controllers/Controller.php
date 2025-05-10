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
        $type = match ($players) {
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

        return $type;
    }

    public function addFirstJoin($guid, $name)
    {
        $addJoin = Join::updateOrCreate([
            'guid' => $guid,
        ],[
            'name' => $name,
        ]);
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
                default => 'NaN',
            };

            return $match;
        }

        return $level;
    }
}
