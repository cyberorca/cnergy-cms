<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class AccordionMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $accordion;
    
    public function __construct($accordion)
    {
        $this->accordion = $accordion;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.accordion-menu');
    }
}
