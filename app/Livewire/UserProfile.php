<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.app')]
class UserProfile extends Component
{
    public $name;

    public function render()
    {
        return view('livewire.user-profile');
    }
}
