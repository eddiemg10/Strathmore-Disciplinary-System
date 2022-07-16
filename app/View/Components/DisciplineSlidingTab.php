<?php

namespace App\View\Components;

use App\Models\Warning;
use Illuminate\View\Component;

class DisciplineSlidingTab extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $notifications;
    public $focus;

    public function __construct($focus)
    {
        $this->focus = $focus;
        $this->notifications = Warning::whereYear('created_at', date('Y'))->where('resolved', 0)->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.discipline-sliding-tab');
    }
}
