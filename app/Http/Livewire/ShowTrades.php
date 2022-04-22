<?php

namespace App\Http\Livewire;

use App\Models\Trade;
use App\Services\CryptoService;
use Livewire\Component;

class ShowTrades extends Component
{
    public $trade;
    public $currentPrice;
    public $currentBalance;
    public $showCollective;
    public $collapseClass;
    public $openModal = false;
    public $editAble = false;

    protected $listeners = ['closeEditModal','closeModal'];

    public function mount()
    {
        $this->showCollective = false;
        $cryptoService = new CryptoService();

        $this->refreshPrice($this->trade['cryptoId'], $this->trade['summed']);

        $this->trade['img'] = $cryptoService->getCryptoImage($this->trade['cryptoId']);
        $this->trade['class'] = $this->trade['countOfCollective'] > 1 ? ($this->trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
        $this->currentBalance = $cryptoService->getBilance($this->currentPrice, $this->trade['currencySinglePrice'] * $this->trade['summed']);
    }

    public function refreshPrice($cryptoId, $totalValue)
    {
        $priceList = (new CryptoService())->getCryptoPrice($cryptoId);
        $this->currentPrice = $priceList[$cryptoId]['eur'] * $totalValue;
        $this->currentBalance = (new CryptoService())->getBilance($this->currentPrice, $this->trade['currencySinglePrice'] * $totalValue);
    }

    public function extend()
    {
        $this->showCollective = $this->showCollective == true ? false : true;

        // toggle class for view
        if ($this->showCollective) {
            $this->collapseClass = null;
            return;
        }

        $this->collapseClass = $this->trade['class'];
    }

    public function delete($id)
    {
        $idList = explode(',', $id);
        Trade::find($idList)->each->delete();
        $this->trade = null;
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
        return view('livewire.show-trades');
    }
}
