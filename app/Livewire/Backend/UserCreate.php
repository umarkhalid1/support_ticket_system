<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Concerns\WithToastr;
use App\Http\Requests\StoreUserRequest;

#[Layout('layouts.admin.app')]
class UserCreate extends Component
{
    use WithToastr;

    public $name, $email, $password, $role_id;
    public function render()
    {
        if (Auth::user()->hasRole(User::ADMIN_ROLE)) {
            $roles = Role::whereNotIn('name', [User::SUPER_ADMIN_ROLE, User::ADMIN_ROLE])->toBase()->get(['id', 'name']);
        } else {
            $roles = Role::whereNot('name', User::SUPER_ADMIN_ROLE)->toBase()->get(['id', 'name']);
        }
        return view('livewire.backend.user-create', compact('roles'));
    }

    protected function rules()
    {
        return (new StoreUserRequest())->rules();
    }

    public function submit()
    {
        $validatedData = $this->validate();

        // dd($validatedData);
        try {
            DB::beginTransaction();

            $user = new User();

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = $validatedData['password'];

            $roleName = Role::where('id', $validatedData['role_id'])->value('name');

            $user->assignRole($roleName);

            $user->save();

            DB::commit();

            return $this->toastSuccessAndRedirect('User created successfully.', 'users');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->toastError($th->getMessage());
        }
    }
}
