<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditAdmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $type;
    public $title;
    public $admin;
    public $btn;

    public function __construct( $id, $type, $title, $admin, $btn)
    {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->admin = $admin;
        $this->btn = $btn;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-admin');
    }
}
