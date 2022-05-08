<?php

namespace App\Http\Livewire\Trades;

use App\Models\Trade;
use App\Services\CryptoService;
use Livewire\Component;

class Index extends Component
{

    public $trades;
    public $contractId;
    public $tradesKeys = '';
    public $isCollective;
    public $tradesLivePrices = [];
    public $tradesLiveBalance = [];
    public $preferredFiat;

    public $collapseClasses;

    protected $listeners = ['openModal', 'delete', 'refreshTradesViaId', 'refreshFiat'];

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

        $this->preferredFiat = $this->emitTo('fiat', 'getFiat') ?? 'eur';
        if ($this->trades) $this->refreshPrices();
    }

    public function refreshPrices()
    {
        $this->getCurrencyPrices();
        foreach (explode(',', $this->tradesKeys) as $key) {
            $trade = &$this->trades[$key];
            $cryptoId = $trade['cryptoId']; // kann das weg?
            $this->tradesLiveBalance[$key] = (new CryptoService())->getBilance($this->tradesLivePrices[$key][$this->preferredFiat], $trade['currencySinglePrice']);
            $trade['live']['balance'] = $this->tradesLiveBalance[$key];
            $trade['live']['price'] = $this->tradesLivePrices[$key][$this->preferredFiat];
        }
    }

    public function refreshFiat($fiat)
    {
        $this->preferredFiat = $fiat;
        $this->refreshPrices();
    }

    private function getCurrencyPrices()
    {
        $this->tradesLivePrices = (new CryptoService())->getCryptoPrice($this->tradesKeys);
    }

    public function extend($cryptoId)
    {
        $trade = &$this->trades[$cryptoId];
        $trade['domAttributes']['showCollective'] = !($trade['domAttributes']['showCollective'] == true);
    }

    public function delete($id, $cryptoId = null)
    {
        $idList = explode(',', $id);

        $model = Trade::query()->find($idList);
        $model->each->delete();

        // refresh if it is possible
        $this->trades[$cryptoId] = $this->refreshTrades($cryptoId);

        if ($this->trades[$cryptoId] === null) {
            // remove the cryptoId from tradeKeys
            unset($this->trades[$cryptoId]);
            $this->refreshKeyList();
            return null;
        }

        // fill balance with value
        $this->refreshPrices();

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
            $trade = $this->trades[$cryptoId];

            if ($tradeId) {
                $trades = Trade::find($tradeId);
                $trade['currencySinglePrice'] = $trades['currency-single-price'];
                $trades['balance'] = $this->getBalance($trade['live']['price'], ($trades['currency-single-price'] ?? $trade['currencySinglePrice']));
                $trade['id'] = $trades->id;
            }

            $this->emit('openModal', 'modal.trade-info', [
                'trade' => $trade,
                'liveBalance' => $trades['balance'] ?? $this->tradesLiveBalance[$cryptoId],
                'livePrice' => $this->tradesLivePrices[$cryptoId][$this->preferredFiat],
                'showTradeInfo' => true,
                'preferredFiatSymbol' => $this->preferredFiat == 'euro' ? '€' : '$',
            ]);

        } elseif ($type === 'edit') {
            $this->emit('openModal', 'modal.trade-edit', [
                'tradeId' => $this->trades[$cryptoId]['id'],
                'isCollective' => $this->trades[$cryptoId]['isCollective']
            ]);
        }
    }

    public function refreshTrades($cryptoId)
    {
        if (empty($this->trades)) return null;

        $cryptoService = new CryptoService();
        $ids = $this->trades[$cryptoId]['collectiveIds'];
        $trades = Trade::query()->find($ids);

        // if single currency has deleted then nothing is there so exit
        if (empty($trades[0])) return null;

        // if something is remains then create basis structure
        $result = $cryptoService->groupByCryptoId($trades);
        if (!$result) return $this->trades[$cryptoId];

        // keep going and extend the needed properties like, img, class etc.
        $result[$cryptoId] = $this->extendTradesProperties($result[$cryptoId]);

        return $result[$cryptoId];
    }

    public function refreshKeyList()
    {
        $str = null;
        foreach ($this->trades as $key => $trade) {
            $this->tradesKeys = array_key_last($this->trades) === $key ? $str . $key : $str . $key . ',';
        }
    }

    public function extendTradesProperties($trade)
    {
        $cryptoService = new CryptoService();
        $cryptoId = $trade['cryptoId'];

        $trade['img'] = $trade['imgUrl'] ?? $cryptoService->getCryptoImage($cryptoId);
        $trade['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
        $trade['live']['balance'] = $this->tradesLiveBalance[$cryptoId];
        $trade['live']['price'] = $this->tradesLivePrices[$cryptoId] ?? null;
        $trade['domAttributes']['class'] = $trade['countOfCollective'] > 1 ? ($trade['countOfCollective'] > 2 ? 'card-block-multiple' : 'card-block-extend') : '';
        $trade['domAttributes']['showCollective'] = false;

        return $trade;
    }

    public function getBalance($livePrice, $boughtPrice)
    {
        $cryptoService = new CryptoService();
        return $cryptoService->getBilance($livePrice, $boughtPrice);
    }

    public function refreshTradesViaId($cryptoId)
    {
        $result = $this->refreshTrades($cryptoId);

        if ($result) {
            $this->trades[$cryptoId] = $result;
            $this->refreshPrices();
        }
    }

    public function test()
    {
        dump($this->trades);
        dump($this->tradesKeys);
        dump($this->preferredFiat);
    }

    public function render()
    {
        return view('livewire.trades.index');
    }
}


