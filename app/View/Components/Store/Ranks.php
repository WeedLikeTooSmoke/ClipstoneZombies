<?php

namespace App\View\Components\Store;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
Use App\Models\Product;

class Ranks extends Component
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
        return view('components.store.ranks', [
            'ranks' => Product::where('type', 'ranks')->get(),
        ]);
    }
}
