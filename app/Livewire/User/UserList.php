<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserList extends Component
{
    public UserForm $form;

    public function delete($id)
    {
        User::query()->find($id)->delete();
    }

    #[On('user-created')]
    public function updateUserList($user = null)
    {

    }


    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::all(),
        ]);
    }
}
