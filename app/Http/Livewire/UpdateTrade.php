<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Trade;

class UpdateTrade extends Component
{
    public $tradeId;
    public $orderDay;
    public $summed;
    public $img;
    public $modelTrade;

    public function mount()
    {
        $this->modelTrade = Trade::find($this->tradeId);
    }

    public function render()
    {

        return view('livewire.update-trade');
    }
}
