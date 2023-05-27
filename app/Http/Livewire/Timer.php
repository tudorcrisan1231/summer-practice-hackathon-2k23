<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Timer extends Component
{
    public $code;
    public function render()
    {
        return view('livewire.timer');
    }
}
