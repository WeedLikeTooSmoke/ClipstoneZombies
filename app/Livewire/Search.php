<?php

namespace App\Livewire;
use Livewire\WithPagination;

use Livewire\Component;

class Search extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.search', [
            'search' => $this->search
        ]);
    }
}
