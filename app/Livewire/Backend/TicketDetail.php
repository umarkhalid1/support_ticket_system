<?php

namespace App\Livewire\Backend;

use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.app')]
class TicketDetail extends Component
{
    public Ticket $ticket;

    public function mount(Ticket $ticket)
    {
        $user = auth()->user();
        $role = $user->getRoleNames()->first();

        if ($role === User::USER_ROLE && $ticket->user_id !== $user->id) {
            abort(404);
        }

        if ($role === User::SUPPORT_AGENT_ROLE && $ticket->assigned_to !== $user->id) {
            abort(404);
        }

        $ticket->load([
            'user:id,name',
            'category:id,name',
            'assignto:id,name',
            'assignBy:id,name',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.ticket-detail');
    }
}
