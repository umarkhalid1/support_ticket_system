<?php

namespace App\Livewire\Category;

use App\Livewire\Concerns\WithToastr;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin.app')]
class CategoryEdit extends Component
{
    use WithToastr;
    public $category, $name;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:255|unique:categories,name,' . $this->category->id,
        ];
    }

    public function submit()
    {
        $this->validate();
        try {

            DB::beginTransaction();

            $this->category->update([
                'name' => $this->name,
            ]);

            DB::commit();
            return $this->toastSuccessAndRedirect('Category updated successfully.', 'categories');

        } catch (\Throwable $th) {

            DB::rollBack();
            $this->toastError($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.category.category-edit');
    }
}
