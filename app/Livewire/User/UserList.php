<?php

namespace App\Livewire\User;

use Livewire\Component;

class UserList extends Component
{
    public string $name = 'Dariia';
    public string $lastname;
    public string $fullname;

    public string $title;

    public string $secondTitle;

    public array $users = [
        'User1',
        'User2',
        'User3',
    ];

    public string $user;


    public function mount($lastname = 'Sliusar')
    {
        $this->lastname = $lastname;
        $this->fullname = $this->name . ' ' . $this->lastname;
    }

    public function add()
    {
        $this->users[] = $this->user;
        $this->reset('user');
//        $this->users[] = $this->pull('user');
    }

    public function render()
    {
        return view('livewire.user.user-list', [
            'age' => 29
        ])->with(['dog' => 'Rex', 'cat' => 'Murka']);
    }
}
