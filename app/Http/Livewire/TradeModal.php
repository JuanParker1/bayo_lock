<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TradeModal extends Component
{
    public $trade;
    public $currentPrice;
    public $currentBalance;

    public function render()
    {
        return view('livewire.trade-modal');
    }
}
