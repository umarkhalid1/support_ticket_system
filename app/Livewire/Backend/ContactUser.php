<?php

namespace App\Livewire\Backend;

use App\Models\Ticket;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.app')]
class ContactUser extends Component
{
    public $ticket, $message;
    public function mount($id)
    {
        if (empty($id)) {
            abort(403);
        }
        $this->ticket = Ticket::with([
            'user:id,name'
        ])->select(['id', 'user_id', 'description'])->find($id);
    }

    public function render()
    {
        return view('livewire.backend.contact-user');
    }

    protected function rules()
    {
        return [
            'message' => 'required|min:1'
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();

        dd($validatedData);
    }
}
