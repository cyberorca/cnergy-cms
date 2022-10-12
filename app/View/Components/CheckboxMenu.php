<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxMenu extends Component
{
    public $accordion;

    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        return view('components.checkbox-menu');
    }
}
