<?php

namespace App\Livewire\Category;

use App\Livewire\Concerns\WithToastr;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin.app')]
class CategoryIndex extends Component
{
    use WithPagination, WithToastr;

    public $categoryId = null;
    public $showModal = false;

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

    public function confirmDelete($category)
    {
        $this->categoryId = $category;
        $this->showModal = true;
    }

    public function cancel()
    {
        $this->showModal = false;
    }

    public function delete()
    {
        Category::findOrFail($this->categoryId)->delete();

        $this->reset(['categoryId', 'showModal']);
        $this->toastError('Category deleted successfully.');
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

