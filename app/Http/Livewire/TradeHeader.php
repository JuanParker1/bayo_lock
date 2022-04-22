<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TradeHeader extends Component
{
    public $contractId;
    public function render()
    {
        return view('livewire.trade-header');
    }
}
