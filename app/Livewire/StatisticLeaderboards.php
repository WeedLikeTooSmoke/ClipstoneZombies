<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\UsersStats;

class StatisticLeaderboards extends Component
{
    use WithPagination;

    public $orderBy = 'kills';
    public function render()
    {
        return view('livewire.statistic-leaderboards', [
            'records' => UsersStats::orderBy($this->orderBy, 'desc')->limit(10)->get(),
        ]);
    }
}
