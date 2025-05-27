<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;

use App\Models\User;

class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $results = User::inRandomOrder()->limit(16)->get();

        if (!empty($this->search))
        {
            $results = User::search('name', $this->search)->limit(16)->get();
        }

        return view('livewire.search', [
            'results' => $results,
        ]);
    }
}
