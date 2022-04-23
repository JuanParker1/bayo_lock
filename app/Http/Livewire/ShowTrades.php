<?php

namespace App\Http\Livewire;

use App\Models\Trade;
use App\Services\CryptoService;
use Livewire\Component;

class ShowTrades extends Component
{

    public $trades;
    public $tradesKeys = '';
    public $tradesLivePrices = [];
    public $tradesLiveBalance = [];
    public $showCollective = [];
    public $collapseClasses;
    public $openModal = false;
    public $editAble = false;

    protected $listeners = ['closeEditModal', 'closeModal'];

    public function mount()
    {
        $cryptoService = new CryptoService();

        foreach ($this->trades as $key => &$trade) {
            $trade['img'] = $trade['imgUrl'] ?? $cryptoService->getCryptoImage($trade['cryptoId']);
            $trade['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';

            $this->tradesKeys = array_key_last($this->trades) === $key ? $this->tradesKeys . $key : $this->tradesKeys . $key . ',';
            $this->tradesLiveBalance[$key] = null;
            $this->showCollective[$key] = null;
            $this->collapseClasses[$key] = $trade['class'];
        }
        $this->refreshPrices();
    }

    public function refreshPrices()
    {
        $this->getCurrencyPrices();
        foreach (explode(',', $this->tradesKeys) as $key) {
            $trade = $this->trades[$key];
            $this->tradesLiveBalance[$key] = (new CryptoService())->getBilance($this->tradesLivePrices[$key]['eur'], $trade['currencySinglePrice']);
        }
    }

    private function getCurrencyPrices()
    {
        $this->tradesLivePrices = (new CryptoService())->getCryptoPrice($this->tradesKeys);
    }

    public function extend($cryptoId)
    {
        // check if any collapsed is open, close it.
        foreach ($this->showCollective as $key => &$collective) {
            if ($cryptoId == $key) continue;
            $collective = false;
            $this->collapseClasses[$key] = $this->trades[$key]['class'];
        }

        $this->showCollective[$cryptoId] = $this->showCollective[$cryptoId] == true ? false : true;

        // toggle class for view
        if ($this->showCollective[$cryptoId]) {
            $this->collapseClasses[$cryptoId] = null;
            return;
        }

        $this->collapseClasses[$cryptoId] = $this->trades[$cryptoId]['class'];
    }

    public function delete($id)
    {
        $idList = explode(',', $id);
        Trade::find($idList)->each->delete();
        $trade = null;
    }

    public function decrease()
    {
        $this->editAble = True;
    }

    public function closeModal()
    {
        $this->openModal = false;
    }

    public function openModal()
    {
        $this->openModal = true;
    }

    public function closeEditModal()
    {
        $this->editAble = false;
    }

    public function render()
    {
//        return '<h1>asd</h1>';
        return view('livewire.show-trades');
    }
}


