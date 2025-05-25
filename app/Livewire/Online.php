<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Server;

class Online extends Component
{
    public function render()
    {
        return view('livewire.online',[
            'online' => Server::sum('players_count'),
        ]);
    }
}
