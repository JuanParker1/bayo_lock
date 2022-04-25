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

    public $collapseClasses;

    protected $listeners = ['openModal', 'delete'];

    public function mount()
    {
        $cryptoService = new CryptoService();

        foreach ($this->trades as $key => &$trade) {
            $trade['img'] = $trade['imgUrl'] ?? $cryptoService->getCryptoImage($trade['cryptoId']);
            $trade['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
            $trade['live']['balance'] = null;
            $trade['live']['price'] = null;
            $trade['domAttributes']['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
            $trade['domAttributes']['showCollective'] = false;

            $this->tradesKeys = array_key_last($this->trades) === $key ? $this->tradesKeys . $key : $this->tradesKeys . $key . ',';
            $this->tradesLiveBalance[$key] = null;

            $this->collapseClasses[$key] = $trade['class'];
        }

        $this->refreshPrices();
    }

    public function refreshPrices()
    {
        $this->getCurrencyPrices();
        foreach (explode(',', $this->tradesKeys) as $key) {
            $trade = &$this->trades[$key];
            $this->tradesLiveBalance[$key] = (new CryptoService())->getBilance($this->tradesLivePrices[$key]['eur'], $trade['currencySinglePrice']);
            $trade['live']['balance'] = (new CryptoService())->getBilance($this->tradesLivePrices[$key]['eur'], $trade['currencySinglePrice']);
            $trade['live']['price'] = $this->tradesLivePrices[$key]['eur'];
        }
    }

    private function getCurrencyPrices()
    {
        $this->tradesLivePrices = (new CryptoService())->getCryptoPrice($this->tradesKeys);
    }

    public function extend($cryptoId)
    {
        $trade = &$this->trades[$cryptoId];
        $trade['domAttributes']['showCollective'] = $trade['domAttributes']['showCollective'] == true ? false : true;
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
            unset($this->trades[$cryptoId]);
            $this->refreshKeyList();
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
        foreach ($this->trades as $key => $trade) {
            if ($cryptoId == $key) continue;
            $trade['domAttributes']['showCollective'] = false;
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

        if (!$trades) return null;

        $result = $cryptoService->groupByCryptoId($trades);
        if ($result) return $result[$cryptoId];

        return $this->trades[$cryptoId];
    }

    public function refreshKeyList()
    {
        $str = null;
        foreach ($this->trades as $key => $trade){
            $this->tradesKeys = array_key_last($this->trades) === $key ? $str . $key : $str . $key . ',';
        }
    }

    public function refreshClass(){

    }

    public function test()
    {
        dump($this->trades);
//        dump($this->tradesKeys);
//        dump($this->collapseClasses);
//        dump($this->trades['solana']['getBalance']);
    }

    public function render()
    {
//        dump($this->trades['solana']['getBalance']);
//        return '<h1>asd</h1>';
        return view('livewire.show-trades');
    }
}


