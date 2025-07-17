<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.user.user-layout')]
class Home extends Component
{
    public function render()
    {
        // sleep(2);
        return view('livewire.frontend.home');
    }
}
