<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use App\Livewire\Concerns\WithToastr;

#[Layout('layouts.admin.app')]
class CategoryIndex extends Component
{
    use WithPagination, WithToastr;

    #[Url()]
    public $search_by_name = '';

    public function render()
    {
        $categories = Category::query()->select(['id', 'name', 'is_active'])
            ->when($this->search_by_name, function ($query) {
                $query->where('name', 'like', '%' . $this->search_by_name . '%');
            })
            ->paginate(10);

        return view('livewire.category.category-index', [
            'categories' => $categories,
        ]);
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

            Category::findOrFail($id)->delete();

            $this->toastError('Category deleted successfully.');

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            $this->toastError($th->getMessage());
        }
    }

}

