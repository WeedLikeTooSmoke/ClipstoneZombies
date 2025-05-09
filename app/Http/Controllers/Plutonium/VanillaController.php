<?php

namespace App\Http\Controllers\Plutonium;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Plutonium\ApiController;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        if ($player->count() == 0) {
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
        } else {
            if ($player[0]->email_verified_at == null) { $verified = 0; } else { $verified = 1; }

            return response()->json([
                'account-guid' => $player[0]->guid,
                'account-name' => $player[0]->name,
                'account-display-name' => "[^{$player[0]->color}{$player[0]->level}^7][^{$player[0]->color}{$player[0]->rank}^7] ^{$player[0]->color}{$player[0]->name}",
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
}
