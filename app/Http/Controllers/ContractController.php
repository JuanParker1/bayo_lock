<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Trade;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function show($contract_id)
    {
        $contract = Contract::find($contract_id);
        $trades = $contract->trades()->orderBy('currency')->get();

        $previous = null;
        $tradesList = [];

        foreach ($trades as $trade) {
            if (isset($previous) and $trade->currency == $previous->currency) $previous['total-currency'] += $trade['total-currency'];

            $previous = ((!isset($previous) or $trade->currency != $previous->currency) ? $trade : $previous);
            if (!in_array($previous, $tradesList)) array_push($tradesList, $previous);
        }

        return view('contract.show', [
            'contract' => $contract,
            'trades' => $tradesList,
        ]);
    }

    public function createTrade($contract_id)
    {
        return view('trade.create', ['contract_id' => $contract_id]);
    }

    public function storeTrade(Request $request, $contract_id)
    {
        $contract = Contract::find($contract_id);

        $trade = Trade::create([
            'currency' => $request->get('currency'),
            'currency-single-price' => $request->get('currency-single-price'),
            'used-coin' => $request->get('used-coin'),
            'used-coin-size' => $request->get('used-coin-size'),
            'fees' => $request->get('fees'),
            'total-currency' => $request->get('total-currency'),
            'order-day' => $request->get('order-day'),
        ]);

        $contract->trades()->attach($trade);
    }
}
