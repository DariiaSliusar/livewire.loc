<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

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
            'users' => User::query()->orderBy('id', 'desc')->paginate(10, pageName: 'users-page'),
//            'users' => User::query()->orderBy('id', 'desc')->simplePaginate(10, pageName: 'users-page'),
        ]);
    }
}
