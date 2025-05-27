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
        $result = User::inRandomOrder()->limit(16)->get();

        if (!empty($this->search))
        {
            $result = User::search('name', $this->search)->limit(16)->get();
        }

        return view('livewire.search', [
            'result' => $result,
        ]);
    }
}
