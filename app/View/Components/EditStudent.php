<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditStudent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $classrooms;
    public $id;
    public $type;
    public $title;
    public $student;


    public function __construct($classrooms, $id, $type, $title, $student)
    {
        $this->classrooms = $classrooms;
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->student = $student;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.edit-student');
    }
}
