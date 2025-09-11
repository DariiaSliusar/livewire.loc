<?php

use App\Livewire\User\UserCreate;
use App\Livewire\User\UserList;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Route::get('/', UserList::class)->name('home');
Route::get('/create-user', UserCreate::class)->name('user-create');
