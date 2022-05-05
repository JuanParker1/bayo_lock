<?php

namespace App\Http\Livewire\Trades;

use App\Models\Trade;
use Livewire\Component;

class Show extends Component
{
    public $ids;
    public $collective;
    public $livePrice;

    public function mount()
    {
        $this->collective = Trade::find($this->ids);
    }

    public function openModal($id)
    {
        $trade = Trade::find($id);
        $cryptoId = $trade->cryptocurrency->crypto_id;

        $this->emitUp('openModal', 'info', $cryptoId, $id);
    }

    public function render()
    {
        return view('livewire.trades.show');
    }
}
