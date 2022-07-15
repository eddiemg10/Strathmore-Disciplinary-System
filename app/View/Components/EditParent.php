<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditParent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $type;
    public $title;
    public $parent;
    
    public function __construct($id, $type, $title, $parent)
    {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->parent = $parent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-parent');
    }
}
