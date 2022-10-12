<?php

namespace App\View\Components;

use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;

class AccordionMenuItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $item;
    public $path;
    
    public function __construct($item)
    {
        $this->item = $item;
        $this->path = explode('/', URL::current())[4];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.accordion-menu-item');
    }
}
