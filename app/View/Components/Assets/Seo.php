<?php

namespace App\View\Components\Assets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class Seo extends Component
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
        return view('components.assets.seo', [
            'seo' => config('seo.seo'),
            'domain' => config('app.url'),
            'page' => ucfirst(Route::currentRouteName()),
        ]);
    }
}
