<?php

namespace App\Http\Controllers\Plutonium;

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
                'guid' => 0,
                'name' => 0,
                'verified' => 0,
                'rank' => 0,
                'level' => 0,
                'banned' => 0,
                'color' => 0,
            ]);
        } else {
            if ($player[0]->email_verified_at == null) { $verified = 0; } else { $verified = 1; }

            return response()->json([
                'guid' => $player[0]->guid,
                'name' => $player[0]->name,
                'verified' => $verified,
                'rank' => $player[0]->rank,
                'level' => $player[0]->level,
                'banned' => $player[0]->banned,
                'color' => $player[0]->color,
                'border' => "-------------[ ^5Clipstone Zombies^7 ]-------------",
                'messageOne' => "Welcome to Clipstone Zombies. Play fair and enjoy the servers",
                'messageTwo' => "Please read the rules to be sure you're not breaking them",
            ]);
        }
    }
}
