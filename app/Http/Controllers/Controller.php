<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Number;

abstract class Controller
{
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
