<?php

namespace App\Livewire\Backend;

use App\Mail\ReplyAdded;
use Auth;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\TicketReply;
use Livewire\WithFileUploads;
use App\Models\ReplyAttachment;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Livewire\Concerns\WithToastr;
use Mail;

#[Layout('layouts.admin.app')]

class ContactUser extends Component
{
    use WithToastr, WithFileUploads;

    public $id, $message, $userId, $ticket_id, $replies;
    public $ticket_status;

    public $uploadedImages = [];
    protected $listeners = ['newReplyAdded', 'reply-added'];

    public function newReplyAdded()
    {
        $this->loadReplies();

    }

    public function mount()
    {
        $this->loadReplies();
    }

    public function loadReplies()
    {
        $this->replies = TicketReply::with([
            'user:id,name',
            'attachments' => function ($query) {
                $query->select(['id', 'ticket_reply_id', 'file_path']);
            }
        ])
            ->where('ticket_id', $this->id)
            ->latest()
            ->take(20)
            ->get()
            ->reverse();
    }

    #[On('loadMoreReplies')]
    public function loadMoreReplies()
    {
        // dd('this is working fine');
        $newReplies = TicketReply::with([
            'user:id,name',
            'attachments' => function ($query) {
                $query->select(['id', 'ticket_reply_id', 'file_path']);
            }
        ])
            ->where('ticket_id', $this->id)
            ->latest()
            ->skip($this->replies->count())
            ->take(20)
            ->get()
            ->reverse();

        $this->replies = $newReplies->merge($this->replies);
    }

    public function render()
    {
        if (empty($this->id))
            abort(404);

        $ticket = Ticket::with('user:id,name')
            ->select(['id', 'user_id', 'assigned_to', 'description', 'status'])
            ->findOrFail($this->id);

        if ($ticket->status === Ticket::CLOSED_STATUS || $ticket->status === Ticket::RESOLVED_STATUS) {
            abort(403, 'This ticket is alread closed or resolved.');
        }
        if (Auth::user()->hasRole(User::SUPPORT_AGENT_ROLE) && $ticket->assigned_to !== Auth::id()) {
            abort(403, 'You are not authorized to access this ticket.');
        }

        $this->ticket_id = $ticket->id;
        $this->userId = $ticket->user_id;

        return view('livewire.backend.contact-user', [
            'ticket' => $ticket,
            'replies' => $this->replies,
        ]);
    }

    protected function rules()
    {
        return [
            'message' => 'required|min:1',
            'uploadedImages.*' => 'image|max:1024|nullable'
        ];
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $replyData = [
            'message' => $validatedData['message'],
            'ticket_id' => $this->ticket_id,
            'user_id' => auth()->id(),
        ];
        try {
            DB::beginTransaction();

            $ticketReply = TicketReply::create($replyData);

            if (!empty($this->uploadedImages)) {

                foreach ($this->uploadedImages as $index => $image) {

                    $path = $image->store('reply-attachments', 'public');

                    ReplyAttachment::create([
                        'ticket_reply_id' => $ticketReply->id,
                        'file_path' => $path,
                    ]);
                }
            }


            $ticket = Ticket::with('user', 'assignto')->find($this->ticket_id);

            // Send mail
            if (Auth::user()->hasRole(User::USER_ROLE) && $ticket && $ticket->assignto) {
                Mail::to($ticket->assignto->email)->send(new ReplyAdded($ticket, $ticketReply));
            } elseif (Auth::user()->hasRole(User::SUPPORT_AGENT_ROLE) && $ticket && $ticket->user) {
                Mail::to($ticket->user->email)->send(new ReplyAdded($ticket, $ticketReply));
            }

            $this->message = '';
            $this->uploadedImages = [];
            $this->dispatch('newReplyAdded');
            $this->dispatch('reply-added');

            $this->dispatch('clear-images');
            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }

    public function updateTicketStatus()
    {
        $this->validate([
            'ticket_status' => 'required',
        ]);

        if (empty($this->ticket_id)) {
            return $this->toastError('Ticket Id is required.');
        }

        $ticket = Ticket::find($this->ticket_id);

        $ticket->update([
            'status' => $this->ticket_status,
        ]);

        $this->toastSuccess('Ticket status updated successfully.');
    }
}
