<?php

namespace App\Http\Livewire\Trades;

use App\Models\Contract;
use App\Models\Location;
use Livewire\Component;
use App\Models\Trade;
use App\Models\Cryptocurrency;

class Create extends Component
{
    // LIVEWARE variables which are used in view
    public $search = '';
    public $coin = [];
    public $market = '';
    public $location;
    public $results = [];
    public $contractId;
    public $switchScreen = False;

    // FROM named elements
    public $orderDay;
    public $currencyPrice;
    public $currencyTotal;

    // NEXT
    private $availableSites = ['trade-search', 'trade-info', 'market-wallet'];
    public $movementSteps = 0;
    public $pagination = [
        'next' => null,
        'current' => 'trade-search',
        'previous' => null,
    ];

    /**
     * @param $id
     * @param $name
     * @param $symbol
     * @param $img
     */
    public function selectedCoin($id, $name, $symbol, $img)
    {
        $this->coin['id'] = $id;
        $this->coin['name'] = $name;
        $this->coin['symbol'] = $symbol;
        $this->coin['img'] = $img;
        $this->results = null;
        $this->next();
    }

    /**
     * @param $value
     * @return array|void
     */
    public function getCoin($value)
    {
        if (strlen($value) > 2) {
            $value = urlencode($value);
            $coinResults = file_get_contents("https://api.coingecko.com/api/v3/search?query={$value}");
            return array_slice(json_decode($coinResults)->coins, 0, 5);
        }
    }

    /**
     * @param $value
     * @return array|void
     */
    public function getMarketOrWallet($value)
    {
        if (strlen($value) > 2) {
            $value = urlencode($value);
            $coinResults = file_get_contents("https://api.coingecko.com/api/v3/search?query={$value}");

            return array_slice(json_decode($coinResults)->exchanges, 0, 5);
        }
    }

    public function back()
    {
        if ($this->movementSteps === 0) return null;

        $this->movementSteps--;
        $index = $this->movementSteps;

        $this->pagination['next'] = $this->availableSites[$index + 1];
        $this->pagination['current'] = $this->availableSites[$index];
        $this->pagination['previous'] = $index > 0 ? $this->availableSites[$index - 1] : null;
    }

    public function next()
    {
        if ($this->movementSteps === count($this->availableSites)) return null;
        // clear search area
        $this->search = '';
        $this->results = [];

        $this->movementSteps = $this->movementSteps +1;
        $index = $this->movementSteps;

        $this->pagination['next'] = $index + 1 < count($this->availableSites) ? $this->availableSites[$index + 1] : null;
        $this->pagination['current'] = $this->availableSites[$index];
        $this->pagination['previous'] = $this->availableSites[$index - 1];
    }

    public function store()
    {
        $currency = Cryptocurrency::query()->firstOrCreate([
            'name' => $this->coin['name'],
            'crypto_id' => $this->coin['id'],
            'symbol' => $this->coin['symbol'],
            'img' => $this->coin['img']
        ]);

        $location = Location::query()->firstOrCreate([
            'name' => $this->market
        ]);

        $trade = Trade::firstOrCreate([
            'cryptocurrency_id' => $currency->id,
            'currency-single-price' => $this->currencyPrice,
            'total-currency' => $this->currencyTotal,
            'order-day' => $this->orderDay,
            'location_id' => $location->id,
        ]);

        // link
        $contract = Contract::query()->find($this->contractId);

        $contract->trades()->attach($trade);
        return $this->redirect("/contract/{$this->contractId}");
    }

    public function test()
    {
        dump($this->pagination);
        dump($this->movementSteps);
    }

    public function render()
    {
        if (strlen($this->search) > 2 && ($this->coin['name'] ?? false) !== $this->search) {
            $this->results = $this->getCoin($this->search);
        }

        if (strlen($this->market) > 2 && ($this->location['name'] ?? false) !== $this->market) {
            $this->results = $this->getMarketOrWallet($this->market);
        }

        return view('livewire.trades.create', ['results' => $this->results ?? null]);
    }
}
