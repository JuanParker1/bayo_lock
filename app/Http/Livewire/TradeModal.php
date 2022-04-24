<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class TradeModal extends ModalComponent
{
    public $trade;
    public $livePrice;
    public $liveBalance;
    public $showTradeInfo = false;

    public function delete()
    {
        $this->emitTo('show-trades', 'delete', implode(',', [$this->trade['modelId']]), $this->trade['cryptoId']);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.trade-modal');
    }
}
