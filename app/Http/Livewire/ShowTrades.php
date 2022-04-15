<?php

namespace App\Http\Livewire;

use App\Services\CryptoService;
use Livewire\Component;

class ShowTrades extends Component
{
    public $trade;
    public $currentPrice;
    public $showCollective;
    public $tradeClass;

    public function mount()
    {
        $this->showCollective = false;
        $cryptoService = new CryptoService();
        $this->currentPrice = $cryptoService->getCryptoPrice($this->trade['cryptoId']);
        $this->trade['img'] = $cryptoService->getCryptoImage($this->trade['cryptoId']);
        $this->trade['class'] = $this->trade['countOfCollective'] > 1 ? ($this->trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
        $this->tradeClass = $this->trade['class'];
    }

    public function refreshPrice($cryptoId, $totalValue)
    {
//        $cryptoService = new CryptoService();
//        $priceList = $cryptoService->getCryptoPrice($cryptoId);
//        $this->currentPirce = $priceList[$cryptoId]['eur'] * $totalValue;
    }

    public function extend()
    {
        $this->showCollective = $this->showCollective == true ? false : true;

        // toogle class for view
        if ($this->showCollective){
            $this->tradeClass = null;
            return;
        }

        $this->tradeClass = $this->trade['class'];
    }

    public function render()
    {
        return view('livewire.show-trades');
    }
}
