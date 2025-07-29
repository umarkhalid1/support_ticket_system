<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.app')]
class ImageUpload extends Component
{
    public function render()
    {
        return view('livewire.image-upload');
    }
}
