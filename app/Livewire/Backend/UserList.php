<?php

namespace App\Livewire\Backend;

use App\Livewire\Concerns\WithToastr;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin.app')]
class UserList extends Component
{
    use WithPagination, WithToastr;
    public $showModal = false;

    public $userId = null;

    #[Url()]
    public $search_by_name = '';

    public function confirmDelete($user)
    {
        $this->userId = $user;
        $this->showModal = true;
    }

    public function delete()
    {
        try {
            DB::beginTransaction();

            User::findOrFail($this->userId)->delete();

            DB::commit();

            $this->reset(['userId', 'showModal']);
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

    public function render()
    {
        $users = User::query()
            ->select(['id', 'name', 'email'])
            ->when($this->search_by_name, function ($query) {
                $query->where('name', 'like', '%' . $this->search_by_name . '%');
            })
            ->paginate(10);

        return view('livewire.backend.user-list', compact('users'));
    }

    public function clearFilters()
    {
        $this->search_by_name = '';
        $this->resetPage();
    }

    public function updatedSearchByName()
    {
        $this->resetPage();
    }

}
