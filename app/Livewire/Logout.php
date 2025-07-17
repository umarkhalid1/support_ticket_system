<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;


#[Layout('layouts.admin.app')]
class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
