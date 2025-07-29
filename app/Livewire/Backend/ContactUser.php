<?php

namespace App\Livewire\Backend;

use Auth;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use App\Models\TicketReply;
use Livewire\WithFileUploads;
use App\Models\ReplyAttachment;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Livewire\Concerns\WithToastr;

#[Layout('layouts.admin.app')]
class ContactUser extends Component
{
    use WithToastr, WithFileUploads;

    public $id, $message, $userId, $ticket_id;

    public $uploadedImages = [];

    public function loadReplies()
    {
        $ticket = Ticket::with('user:id,name')
            ->select(['id', 'user_id', 'assigned_to', 'description', 'status'])
            ->findOrFail($this->id);

        if ($ticket->status === Ticket::CLOSED_STATUS || $ticket->status === Ticket::RESOLVED_STATUS) {
            abort(403, 'You cannot send messages to this ticket.');
        }
        if (Auth::user()->hasRole(User::SUPPORT_AGENT_ROLE) && $ticket->assigned_to !== Auth::id()) {
            abort(403, 'You are not authorized to access this ticket.');
        }

        $replies = TicketReply::with([
            'user:id,name',
            'attachments' => function ($query) {
                $query->select(['id', 'ticket_reply_id', 'file_path']);
            }
        ])
            ->where('ticket_id', $ticket->id)
            ->get();

        // dd($replies);

        $this->ticket_id = $ticket->id;
        $this->userId = $ticket->user_id;

        return compact('ticket', 'replies');
    }

    public function render()
    {
        if (empty($this->id))
            abort(404);

        $data = $this->loadReplies();

        return view('livewire.backend.contact-user', $data);
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

            $this->message = '';
            $this->uploadedImages = [];
            // $this->dispatch('messageSent');
            $this->dispatch('message-sent');
            $this->dispatch('clear-images');

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }
}
