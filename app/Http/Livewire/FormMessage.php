<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormMessage extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.form-message');
    }
}
