<?php

namespace App\View\Components\Homepage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\UsersStats;

class Statistics extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $highestRound = Cache::remember('highestRound', 10, function () {
             return User::sum('banned');
        });

        $zombiesKilled = Cache::remember('zombiesKilled', 10, function () {
             return UsersStats::sum('kills');
        });

        $moneyAccumulated = Cache::remember('moneyAccumulated', 10, function () {
             return UsersStats::sum('score');
        });

        $missionsCompleted = Cache::remember('missionsCompleted', 10, function () {
             return User::sum('banned');
        });

        $moneyGambled = Cache::remember('moneyGambled', 10, function () {
             return User::sum('banned');
        });

        $bossesKilled = Cache::remember('bossesKilled', 10, function () {
             return UsersStats::sum('avogadro_defeated') + UsersStats::sum('prison_brutus_killed') + UsersStats::sum('tomb_mechz_killed');
        });

        $distanceTraveled = Cache::remember('distanceTraveled', 10, function () {
            return UsersStats::sum('distance_traveled');
        });

        $playersBanned = Cache::remember('playersBanned', 10, function () {
            return User::sum('banned');
        });

        return view('components.homepage.statistics', [
            'highestRound' => $highestRound,
            'zombiesKilled' => $zombiesKilled,
            'moneyAccumulated' => $moneyAccumulated,
            'missionsCompleted' => $missionsCompleted,
            'moneyGambled' => $moneyGambled,
            'bossesKilled' => $bossesKilled,
            'distanceTraveled' => $distanceTraveled,
            'playersBanned' => $playersBanned,
        ]);
    }
}
