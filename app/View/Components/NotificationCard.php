<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotificationCard extends Component
{
    public $title;
    public $desc;
    public $time;

    public function __construct($title, $desc, $time)
    {
        $this->title = $title;
        $this->desc = $desc;
        $this->time = $time;
    }

    public function render()
    {
        return view('components.notification-card');
    }
}
