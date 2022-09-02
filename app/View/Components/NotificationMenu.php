<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class NotificationMenu extends Component
{
    public $notifications;
    public $new;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count=10)
    {
        $user = Auth::user();
        $this->notifications=$user->notifications()->take($count)->get();//في لارفيل علاقلة بين اليوزر وال نوتيفيكاشن
        $this->new=$user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-menu');
    }
}
