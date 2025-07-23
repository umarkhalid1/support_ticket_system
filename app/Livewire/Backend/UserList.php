<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Livewire\Concerns\WithToastr;

#[Layout('layouts.admin.app')]
class UserList extends Component
{
    use WithPagination, WithToastr;

    #[Url()]
    public $search_by_name = '';
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

    public function confirmDelete($id)
    {
        $this->dispatch('deleteConfirmation', id: $id);
    }

    #[On('delete')]
    public function delete($id)
    {
        try {
            DB::beginTransaction();

            User::findOrFail($id)->delete();

            $this->toastError('User deleted successfully.');

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->toastError($th->getMessage());
        }
    }

}
