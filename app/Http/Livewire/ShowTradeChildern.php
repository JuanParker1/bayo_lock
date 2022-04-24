<?php

namespace App\Http\Livewire;

use App\Models\Trade;
use Livewire\Component;

class ShowTradeChildern extends Component
{
    public $ids;
    public $collective;

    public function mount()
    {
        $this->collective = Trade::find($this->ids);
    }

    public function openModal($id)
    {
        $trade = Trade::find($id);
        $cryptoId = $trade->cryptocurrency->crypto_id;

        $this->emitUp('openModal', 'info', $cryptoId,);
    }

    public function render()
    {
        return view('livewire.show-trade-childern');
    }
}
