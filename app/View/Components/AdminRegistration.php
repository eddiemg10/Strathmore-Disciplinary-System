<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminRegistration extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $btn;
     public $title;

    public function __construct($btn, $title)
    {
        $this->btn = $btn;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-registration');
    }
}
