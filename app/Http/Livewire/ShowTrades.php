<?php

namespace App\Http\Livewire;

use App\Models\Trade;
use App\Services\CryptoService;
use Livewire\Component;

class ShowTrades extends Component
{

    public $trades;
    public $tradesKeys = '';
    public $isCollective;
    public $tradesLivePrices = [];
    public $tradesLiveBalance = [];

    public $showCollective = [];
    public $collapseClasses;

    protected $listeners = ['openModal', 'delete'];

    public function mount()
    {
        $cryptoService = new CryptoService();

        foreach ($this->trades as $key => &$trade) {
            $trade['img'] = $trade['imgUrl'] ?? $cryptoService->getCryptoImage($trade['cryptoId']);
            $trade['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
            $trade['balance'] = null;

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
        $this->collapseRollBack($cryptoId);
        $this->showCollective[$cryptoId] = $this->showCollective[$cryptoId] == true ? false : true;

        // toggle class for view
        if ($this->showCollective[$cryptoId]) {
            $this->collapseClasses[$cryptoId] = null;
            return;
        }

        $this->collapseClasses[$cryptoId] = $this->trades[$cryptoId]['class'];
    }

    public function delete($id, $cryptoId = null)
    {
        $idList = explode(',', $id);
        $model = Trade::find($idList);
        $model->each->delete();

        // refresh if it is possible
        $this->trades[$cryptoId] = $this->refreshTrades($cryptoId);
        if ($this->trades[$cryptoId] === null) {
            // remove the cryptoId from tradeKeys
            $this->tradesKeys = str_replace([',' . $cryptoId, $cryptoId], '', $this->tradesKeys);
            unset($this->trades[$cryptoId]);
            unset($this->collapseClasses[$cryptoId]);
            return null;
        }

        //adding class to new column
        $this->trades[$cryptoId]['class'] = $this->trades[$cryptoId]['countOfCollective'] > 1 ? ($this->trades[$cryptoId]['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';

        // if collapse is opend close it
        if ($this->trades[$cryptoId]['isCollective']) {
            $this->collapseRollBack(false);
        }
    }

    protected function collapseRollBack($cryptoId = null)
    {
        foreach ($this->showCollective as $key => &$collective) {
            if ($cryptoId == $key) continue;
            $collective = false;

            $this->collapseClasses[$key] = $this->trades[$key]['class'];
        }
    }

    public function openModal($type, $cryptoId, $tradeId = null)
    {
        if ($type === 'info') {

            if ($tradeId) {
                $trades = $this->trades[$cryptoId];
                $trades['modelId'] = $tradeId;
            }

            $this->emit('openModal', 'trade-modal', [
                'trade' => $trades ?? $this->trades[$cryptoId],
                'liveBalance' => $this->tradesLiveBalance[$cryptoId],
                'livePrice' => $this->tradesLivePrices[$cryptoId]['eur'],
                'showTradeInfo' => true,
            ]);
        } elseif ($type === 'edit') {
            $this->emit('openModal', 'update-trade', [
                'tradeId' => $this->trades[$cryptoId]['id'],
                'isCollective' => $this->trades[$cryptoId]['isCollective']
            ]);
        }
    }

    public function refreshTrades($cryptoId)
    {
        $cryptoService = new CryptoService();
        $ids = $this->trades[$cryptoId]['collectiveIds'];
        $trades = Trade::find($ids)->first();

        if (!$trades) {
            return null;
        }
//        $result = $cryptoService->groupByCryptoId($trades);
//
//        if ($result) {
//            return $result[$cryptoId];
//        }

        return $this->trades[$cryptoId];
    }

    public function test()
    {
        dump($this->trades);
        dump($this->tradesKeys);
        dump($this->collapseClasses);
    }

    public function render()
    {
//        return '<h1>asd</h1>';
        return view('livewire.show-trades');
    }
}


