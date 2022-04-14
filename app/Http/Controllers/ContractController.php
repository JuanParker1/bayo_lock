<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Investor;
use App\Models\Trade;
use App\Services\CryptoService;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function show($contract_id)
    {
        $contract = Contract::find($contract_id);

        // fasse alle crypto mit dem selbigen ID's zusammen.
        // dabei setze die crypto classen zusammen beo
         $trades = (new CryptoService)->groupByCryptoId($contract->trades);

        return view('contract.show', [
            'contract' => $contract,
            'trades' => $trades
        ]);
    }

    public function create()
    {
        return view('contract.create');
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

    public function extend($contract_id, $investor_id)
    {
        $investor = Investor::find($investor_id);

        return view('contract.extend')->with([
            'investor' => $investor,
            'contract' => $investor->contracts->find($contract_id)
        ]);
    }

    public function destory($id,$investorId)
    {
        Contract::find($id)->delete();
        return redirect('/investor/'.$investorId);
    }
}
