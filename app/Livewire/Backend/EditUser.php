<?php

namespace App\Livewire\Backend;

use App\Livewire\Concerns\WithToastr;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin.app')]
class EditUser extends Component
{
    use WithToastr;

    public $user, $name, $email, $password, $roles, $role_id;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = Role::toBase()->get();
        $this->role_id = $user->roles()->pluck('id')->first();
    }

    public function render()
    {
        return view('livewire.backend.edit-user');
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:users,name,' . $this->user->id,
            'email' => 'required|unique:users,email,' . $this->user->id,
            'password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }

        $this->user->update($data);

        $roleName = Role::find($this->role_id)->name;
        $this->user->syncRoles([$roleName]);

        return $this->toastSuccessAndRedirect('User updated successfully.', 'users');
    }
}
