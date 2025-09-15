<?php

namespace App\Livewire;

use Livewire\Component;

class SelectComponent extends Component
{
    public $items;

    public function mount($items)
    {
        $this->items = $items;
    }

    public function render()
    {
        return view('livewire.select-component');
    }
}
