<?php

namespace App\Http\Livewire;

use App\Models\Contract;
use Livewire\Component;
use App\Models\Trade;
use App\Models\Cryptocurrency;

class CreateTrades extends Component
{
    // LIVEWARE variables which are used in view
    public $search = '';
    public $coin = [];
    public $results = [];
    public $contractId;
    public $switchScreen = False;

    // FROM named elements
    public $orderDay;
    public $currencyPrice;
    public $currencyTotal;


    public function selectedCoin($id, $name, $symbol, $img)
    {
        $this->coin['id'] = $id;
        $this->coin['name'] = $name;
        $this->coin['symbol'] = $symbol;
        $this->coin['img'] = $img;
        $this->results = null;
        $this->switchScreen = True;
    }

    public function getCoin($value)
    {
        if (strlen($value) > 2) {
            $value = urlencode($value);
            $coinResults = file_get_contents("https://api.coingecko.com/api/v3/search?query={$value}");
            return array_slice(json_decode($coinResults)->coins, 0, 5);
        }
    }

    public function back()
    {
        $this->switchScreen = False;
        return;
    }

    public function store()
    {
        $currency = Cryptocurrency::firstOrCreate([
            'name' => $this->coin['name'],
            'crypto_id' => $this->coin['id'],
            'symbol' => $this->coin['symbol'],
            'img' => $this->coin['img']
        ]);

        $trade = Trade::firstOrCreate([
            'cryptocurrency_id' => $currency->id,
            'currency-single-price' => $this->currencyPrice,
            'total-currency' => $this->currencyTotal,
            'order-day' => $this->orderDay
        ]);

        // link
        $contract = Contract::find($this->contractId);

        $contract->trades()->attach($trade);
        return $this->redirect("/contract/{$this->contractId}");
    }

    public function render()
    {
        if (strlen($this->search) > 2 && ($this->coin['name'] ?? false) !== $this->search) {
            $this->results = $this->getCoin($this->search);
        }

        return view('livewire.create-trades', ['coins' => $this->results ?? null]);
    }
}
