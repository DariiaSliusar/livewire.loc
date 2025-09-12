<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Database\Query\Builder;
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

    public array $limitList = [10, 25, 50, 100];

    #[Url]
    public string $search = '';

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

    public function updating($property, $value)
    {
        if ($property == 'search') {
            $this->resetPage();
        }
    }
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
//        $users = User::query()
//            ->with('country')
//            ->when($this->search, function ($query) {
//                $query->whereLike('name', '%' . $this->search . '%')
//                    ->orWhereLike('email', '%' . $this->search . '%');
//            })
//            ->orderBy('id', 'desc')
//            ->paginate($this->limit);

        $users = User::query()
            ->select('users.id', 'users.name', 'users.email', 'countries.name as country_name')
            ->join('countries', 'users.country_id', '=', 'countries.id')
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'users.id', 'users.name', 'users.email', 'countries.name'
                ], 'like', '%'.$this->search.'%');
//
//                $query->whereLike('users.id', '%'.$this->search.'%')
//                    ->orWhereLike('users.name', '%'.$this->search.'%')
//                    ->orWhereLike('users.email', '%'.$this->search.'%')
//                    ->orWhereLike('countries.name', '%'.$this->search.'%');
            })
            ->orderBy('users.id', 'desc')
            ->paginate($this->limit);

        return view('livewire.user.user-list', [
            'users' => $users,
//            'users' => User::query()->orderBy('id', 'desc')->simplePaginate(10, pageName: 'users-page'),
        ]);
    }
}
