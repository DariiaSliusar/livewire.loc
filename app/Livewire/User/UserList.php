<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserList extends Component
{
    #[Validate('required', message: 'Поле обовязкове для заповнення')]
    #[Validate('min:2', as: 'Імя')]
    #[Validate('max:25')]
    public string $name;

    #[Validate('required|email|max:30')]
    public string $email;

    #[Validate('required|min:6')]
    public string $password;

    protected function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:30',
            'password' => 'required|min:6',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required' => 'Поле обовязкове для заповнення',
            'name.min' => 'Імя повинно містити мінімум 2 символи',
            'name.max' => 'Імя повинно містити максимум 255 символів',
            'email.required' => 'Поле обовязкове для заповнення',
            'email.email' => 'Введіть коректний email',
            'email.max' => 'Email повинен містити максимум 30 символів',
            'password.required' => 'Поле обовязкове для заповнення',
            'password.min' => 'Пароль повинен містити мінімум 6 символів',
        ];
    }


    public function save()
    {
//        $validated = $this->validate([
//            'name' => 'required|min:2|max:255',
//            'email' => 'required|email|max:30',
//            'password' => 'required|min:6',
//        ]);

        $validated = $this->validate();

        User::create($validated);

        $this->reset();
    }

    public function delete($id)
    {
        User::query()->find($id)->delete();
    }

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::all(),
        ]);
    }
}
