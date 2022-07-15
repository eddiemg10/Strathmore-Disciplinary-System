<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentRegistrationCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $classrooms;
    public $id;
    public $type;
    public $btn;
    public $title;
    



    public function __construct($classrooms, $id, $type, $btn, $title)
    {
        $this->classrooms = $classrooms;
        $this->id = $id;
        $this->type = $type;
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
        return view('components.student-registration-card');
    }
}
