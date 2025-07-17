<?php

namespace App\Livewire;

use App\Livewire\Concerns\WithToastr;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class StatusUpdate extends Component
{
    use WithToastr;
    public Model $model;
    
    public $field;

    public $isActive;

    public function mount()
    {
        $this->isActive = (bool) $this->model->getAttribute($this->field);
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
        $this->toastSuccess('Status updated successfully.');
    }

    public function render()
    {
        return view('livewire.status-update');
    }
}
