<?php

namespace App\Livewire\Frontend;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\Category;
use App\Mail\TicketCreated;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Concerns\WithToastr;
use App\Http\Requests\StoreTicketRequest;
use Livewire\WithFileUploads;

#[Layout('layouts.user.user-layout')]
class TicketCreate extends Component
{
    use WithToastr, WithFileUploads;

    public $title = '';
    public $category_id = '';
    public $description = '';
    public $attachement;
    public $priority = 'low';


    public function render()
    {
        // sleep(2);
        $categories = Category::active()->toBase()->get(['id', 'name']);
        return view('livewire.frontend.ticket-create', compact('categories'));
    }

    protected function rules()
    {
        return (new StoreTicketRequest())->rules();
    }

    public function submit()
    {
        $validatedData = $this->validate();

        if (!Auth::check()) {
            $this->reset('title', 'priority', 'description', 'category_id');
            return session()->flash('errorLogin', 'User must login before creating ticket.');
        }

        try {
            DB::beginTransaction();

            if ($this->attachement) {
                $validatedData['attachement'] = $this->attachement->store('tickets', 'public');
            }

            $ticket = new Ticket($validatedData);
            $ticket->user_id = Auth::id();
            $ticket->save();

            Mail::to('admin@gmail.com')->queue(new TicketCreated($ticket));


            DB::commit();
            $this->reset('title', 'priority', 'description', 'category_id', 'attachement');

            return session()->flash('success', 'Ticket created successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return session()->flash('error', $th->getMessage());
        }
    }

}
