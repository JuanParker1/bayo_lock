<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use App\Services\CryptoService;
use Livewire\Component;

class ShowTrades extends Component
{
    public $trade;
    public $currentPrice;

    public function mount(){
        $cryptoService = new CryptoService();
        $this->currentPrice = $cryptoService->getCryptoPrice($this->trade['cryptoId']);
        $this->trade['img'] = $cryptoService->getCryptoImage($this->trade['cryptoId']);
        $this->trade['class'] = $this->trade['countOfCollective'] > 1 ? ($this->trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
    }

    public function refreshPrice($cryptoId, $totalValue)
    {
//        $cryptoService = new CryptoService();
//        $priceList = $cryptoService->getCryptoPrice($cryptoId);
//        $this->currentPirce = $priceList[$cryptoId]['eur'] * $totalValue;
    }

    public function render()
    {
        return view('livewire.show-trades');
    }
}

/**
 * $cryptoService = new CryptoService();
 *
 * $contract = Contract::find($this->contractId);
 * $trades = $contract->trades;
 *
 * $this->tradesList = $cryptoService->groupByCryptoId($trades);
 * $cryptoIds = implode(',', array_keys($this->tradesList));
 * $this->priceList = $cryptoService->getCryptoPrice($cryptoIds);
 * $this->cryptoImage = $cryptoService->getCryptoImage($cryptoIds);
 *
 * return view('livewire.show-trades', [
 * 'contract' => $contract,
 * 'trades' => $this->tradesList,
 * ]);
 */
