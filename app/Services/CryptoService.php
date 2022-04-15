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
                'name' => $trade[0]->cryptocurrency->name,
                'cryptoId' => $trade[0]->cryptocurrency->crypto_id,
                'currencySinglePrice' => $trade[0]['currency-single-price'],
                'totalCurrency' => $trade[0]['total-currency'],
                'orderDay' => $trade[0]['order-day'],
//                'collectionSampler' => count($trade) > 1 ? $trade : [],
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
    public function getCryptoPrice($cryptocurrencies, $fiat='eur')
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

    /**
     * @param $cryptoId
     * @param $cryptocurrencies
     * @param string $fiat
     * @return array
     * @throws \Exception
     */
    public function createCurrencyObject($cryptoId, $cryptocurrencies, $fiat = 'eur') :array
    {
        $currencyGroupBy = $this->groupByCryptoId($cryptoId);
        return [
            'currencyId' => $cryptoId,
            'name' => $currencyGroupBy->collection['name'],
            'order-by' => $currencyGroupBy->collection['order-day'],
            'total-currency' => $currencyGroupBy->collection['total-currency'],
            'total-price' => (float)$currencyGroupBy->collection['total-currency'] * (float)$currencyGroupBy->collection['currency-single-price'],
            'currency_array' => $currencyGroupBy->collectionSampler,
            'image' => (object)$this->getCryptoImage($cryptoId),
            'current-price' => $this->getCryptoPrice($cryptocurrencies, $fiat)
        ];
    }
}
