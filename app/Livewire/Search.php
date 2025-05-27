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
        return view('livewire.search', [
            'results' => User::search('name', $this->search)->paginate(16),
        ]);
    }
}
