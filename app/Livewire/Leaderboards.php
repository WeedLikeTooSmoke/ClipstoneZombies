<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Leaderboard;
class Leaderboards extends Component
{
    use WithPagination;

    public $type = 1;
    public function render()
    {
        return view('livewire.leaderboards', [
            'records' => Leaderboard::where('players_count', $this->type)->orderBy('round', 'desc')->limit(10)->get(),
        ]);
    }
}
