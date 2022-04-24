<?php

namespace App\Services;

use App\Models\Cryptocurrency;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CryptoService
{
    private $client;

    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    /**
     * @param $trades
     * @return array
     */
    public function groupByCryptoId($trades): array
    {
        $array = array();

        foreach ($trades->groupBy('cryptocurrency_id') as $trade) {
            $array[$trade[0]->cryptocurrency->crypto_id] = [
                'id' => $trade[0]->id,
                'summed' => $trade->sum('total-currency'),
                'imgUrl' => $trade[0]->img,
                'name' => $trade[0]->cryptocurrency->name,
                'cryptoId' => $trade[0]->cryptocurrency->crypto_id,
                'currencySinglePrice' => $trade[0]['currency-single-price'],
                'totalCurrency' => $trade[0]['total-currency'],
                'orderDay' => $trade[0]['order-day'],
                'isCollective' => count($trade) > 1,
                'collectiveIds' => $trade->pluck('id')->toArray(),
                'countOfCollective' => count($trade),
            ];
        }

        return $array;
    }

    /**
     * @param $cryptocurrencies
     * @param string $fiat
     * @return array
     * @throws \Exception
     */
    public function getCryptoPrice($cryptocurrencies, $fiat = 'eur')
    {
        return $this->client->simple()->getPrice($cryptocurrencies, $fiat);
    }

    /**
     * @param $cryptoId
     * @return mixed
     * @throws \Exception
     */
    public function getCryptoImage($cryptoId)
    {
        return $this->client
            ->coins()
            ->getCoin($cryptoId, ['tickers' => 'false', 'market_data' => 'false', 'developer_data' => 'false', 'sparkline' => 'false'])
        ['image'];
    }

    public function getBilance($livePrice, $purchasePrice)
    {
        return [
            'balance' => $livePrice - $purchasePrice,
            'percentage' => ($livePrice - $purchasePrice) / $purchasePrice * 100
        ];
    }
}
