<?php

namespace App\Livewire\Backend;

use App;
use Mail;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\Category;
use App\Mail\TicketAssigned;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Concerns\WithToastr;

#[Layout('layouts.admin.app')]
class TicketList extends Component
{
    use WithPagination, WithToastr;
    public $showModal = false;
    public $ticketID = null;
    protected $listeners = ['updateAssignedTo', 'updatePriority', 'updateStatus'];

    public $search_category_id = '';
    public $search_status = '';
    public $search_priority = '';

    public array $queryString = [
        'search_category_id' => ['except' => ''],
        'search_status' => ['except' => ''],
        'search_priority' => ['except' => ''],
    ];

    public function render()
    {
        $query = [];

        $isUser = Auth::user()->hasRole(User::USER_ROLE);
        $isSupportAgent = Auth::user()->hasRole(User::SUPPORT_AGENT_ROLE);

        $userId = Auth::id();

        if ($isUser) {
            $query = Ticket::where('user_id', $userId)->with([
                'user:id,name',
                'assignto:id,name',
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ]);
        } else if ($isSupportAgent) {
            $query = Ticket::where('assigned_to', $userId)->with([
                'user:id,name',
                'assignto:id,name',
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ]);
        } else {
            $query = Ticket::with([
                'user:id,name',
                'assignto:id,name',
                'category' => function ($query) {
                    $query->select('id', 'name');
                },
            ]);
        }

        // dd($query);

        if (!empty($this->search_category_id)) {
            $query->where('category_id', $this->search_category_id);
        }

        if (!empty($this->search_status)) {
            // dd($this->search_status);
            $query->where('status', $this->search_status);
        }

        if (!empty($this->search_priority)) {
            // dd($this->search_priority);
            $query->where('priority', $this->search_priority);
        }

        $tickets = $query->paginate(10);
        $categories = Category::toBase()->get(['id', 'name']);
        $supportAgents = User::role(User::SUPPORT_AGENT_ROLE)->toBase()->get(['id', 'name']);

        return view('livewire.backend.ticket-list', compact('tickets', 'categories', 'supportAgents'));
    }

    public function clearFilters()
    {
        $this->search_category_id = '';
        $this->search_status = '';
        $this->search_priority = '';
        $this->resetPage();
    }
    public function updatedSearchCategoryId()
    {
        $this->resetPage();
    }

    public function updatedSearchStatus()
    {
        $this->resetPage();
    }

    public function updatedSearchPriority()
    {
        $this->resetPage();
    }

    public function updateAssignedTo($ticketId, $userId)
    {
        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($ticketId);
            $ticket->assigned_to = $userId;
            $ticket->save();

            $user = User::findOrFail($userId);
            Mail::to($user->email)->send(new TicketAssigned($ticket));

            DB::commit();
            return $this->toastSuccess('Ticket assigned successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }

    public function updatePriority($ticketId, $priority)
    {
        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($ticketId);
            $ticket->priority = $priority;
            $ticket->save();

            DB::commit();
            return $this->toastSuccess('Ticket priority updated.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }

    public function updateStatus($ticketId, $status)
    {
        try {
            DB::beginTransaction();

            $ticket = Ticket::findOrFail($ticketId);
            $ticket->status = $status;
            $ticket->save();

            DB::commit();
            return $this->toastSuccess('Ticket status updated.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }

    public function confirmDelete($ticket)
    {
        $this->ticketID = $ticket;
        $this->showModal = true;
    }

    public function delete()
    {
        try {
            DB::beginTransaction();

            Ticket::findOrFail($this->ticketID)->delete();

            DB::commit();

            $this->reset(['ticketID', 'showModal']);
            $this->toastError('User deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }

    public function cancel()
    {
        $this->showModal = false;
    }
}
