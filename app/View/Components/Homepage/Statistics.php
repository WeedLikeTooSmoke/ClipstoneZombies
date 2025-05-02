<?php

namespace App\View\Components\Homepage;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;

use App\Models\User;

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
        $userCount = Cache::remember('userCount', 10, function () {
            return User::all()->count();
        });

        return view('components.homepage.statistics', [
            'userCount' => $userCount,
        ]);
    }
}
