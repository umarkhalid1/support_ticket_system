<?php

namespace App\Livewire\Category;

use App\Http\Requests\StoreCategoryRequest;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Livewire\Concerns\WithToastr;

#[Layout('layouts.admin.app')]
class CategoryForm extends Component
{
    use WithToastr;

    public $name = '';

    protected function rules(): array
    {
        return (new StoreCategoryRequest())->rules();
    } 

    public function submit()
    {
        $validated = $this->validate();

        try {
            DB::beginTransaction();

            Category::create($validated);

            DB::commit();

            return $this->toastSuccessAndRedirect('Category created successfully!', 'categories');

        } catch (\Throwable $th) {

            DB::rollBack();
            $this->toastError($th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.category.category-form');
    }
}