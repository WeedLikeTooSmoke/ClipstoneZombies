<?php

namespace App\View\Components\Homepage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\UsersStats;
use App\Models\Leaderboard;

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
        $highestRound = Cache::remember('highestRound', 300, function () {
             return Leaderboard::max('round') ?? 0;
        });

        $zombiesKilled = Cache::remember('zombiesKilled', 300, function () {
             return UsersStats::sum('kills');
        });

        $moneyAccumulated = Cache::remember('moneyAccumulated', 300, function () {
             return "£".number_format(UsersStats::sum('score'));
        });

        $missionsCompleted = Cache::remember('missionsCompleted', 300, function () {
             return UsersStats::sum('missions_completed');
        });

        $moneyGambled = Cache::remember('moneyGambled', 300, function () {
             return UsersStats::sum('money_gambled');
        });

        $bossesKilled = Cache::remember('bossesKilled', 300, function () {
             return UsersStats::sum('bosses_killed');
        });

        $distanceTraveled = Cache::remember('distanceTraveled', 300, function () {
            return number_format(UsersStats::sum('distance_traveled') * 0.0254);
        });

        $playersBanned = Cache::remember('playersBanned', 300, function () {
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
