<?php

namespace App\Http\Livewire\Modal;

use App\Models\Trade;
use LivewireUI\Modal\ModalComponent;

class TradeInfo extends ModalComponent
{
    public $trade;
    public $liveBalance;
    public $livePrice;
    public $showTradeInfo = false;
    public $preferredFiatSymbol;
    public $model;

    public function mount()
    {
        $this->model = Trade::query()->find($this->trade['id']);
    }

    public function edit($cryptoId)
    {
        $this->emitTo('trades.index', 'openModal', 'edit', $cryptoId);
    }

    public function delete()
    {
        $this->emitTo('trades.index', 'delete', implode(',', [$this->trade['id']]), $this->trade['cryptoId']);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal.trade-info');
    }
}
