<?php

namespace App\View\Components;

use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class CheckboxMenuItem extends Component
{
    public $item;
    public $method;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($item)
    {
        $currentUrl = explode('/', URL::current());
        $this->item = $item;
        $this->method = end($currentUrl);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox-menu-item');
    }
}
