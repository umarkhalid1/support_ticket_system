<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin.app')]
class Dashboard extends Component
{
    public function render()
    {
        $totalTickets = [];
        $statusCounts = [];
        $priorityCounts = [];

        $isUser = Auth::user()->getRoleNames()->first() == User::USER_ROLE;
        $isSupportAgent = Auth::user()->getRoleNames()->first() == User::SUPPORT_AGENT_ROLE;

        $userId = Auth::id();

        if ($isSupportAgent) {

            $totalTickets = Ticket::where('assigned_to', $userId)->count();

            $statusCounts = Ticket::where('assigned_to', $userId)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $priorityCounts = Ticket::where('assigned_to', $userId)
                ->select('priority', DB::raw('count(*) as count'))
                ->groupBy('priority')
                ->pluck('count', 'priority')
                ->toArray();

        } else if ($isUser) {

            $totalTickets = Ticket::where('user_id', $userId)->count();

            $statusCounts = Ticket::where('user_id', $userId)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $priorityCounts = Ticket::where('user_id', $userId)
                ->select('priority', DB::raw('count(*) as count'))
                ->groupBy('priority')
                ->pluck('count', 'priority')
                ->toArray();
                
        } else {

            $totalTickets = Ticket::count();

            $statusCounts = Ticket::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $priorityCounts = Ticket::select('priority', DB::raw('count(*) as count'))
                ->groupBy('priority')
                ->pluck('count', 'priority')
                ->toArray();
        }

        return view('livewire.dashboard', compact(
            'totalTickets',
            'statusCounts',
            'priorityCounts'
        ));
    }
}
