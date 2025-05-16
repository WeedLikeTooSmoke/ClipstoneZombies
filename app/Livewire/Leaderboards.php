<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Leaderboard;
class Leaderboards extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.leaderboards', [
            'records' => Leaderboard::orderBy('round', 'desc')->paginate(10),
        ]);
    }
}
