<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderMenu extends Component
{
    /**
     * Create a new component instance.
     */

    public $categories;

    public function __construct()
    {
        return $this->categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-menu');
    }
}
