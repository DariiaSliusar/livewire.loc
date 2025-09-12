<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    #[Url]
    public int $limit = 10;

    public array $limitList = [ 10, 25, 50, 100 ];

    public function mount(): void
    {
        if (!in_array($this->limit, $this->limitList)) {
            $this->redirectRoute('home');
        }
    }

//    public function changeLimit($limit)
//    {
//        $this->limit = in_array($limit, $this->limitList) ? $limit : $this->limitList[0];
//
//        $this->resetPage();
//    }

    public function changeLimit()
    {
        $this->limit = in_array($this->limit, $this->limitList) ? $this->limit : $this->limitList[0];

        $this->resetPage();
    }

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
            'users' => User::query()->with('country')->orderBy('id', 'desc')->paginate($this->limit),
//            'users' => User::query()->orderBy('id', 'desc')->simplePaginate(10, pageName: 'users-page'),
        ]);
    }
}
