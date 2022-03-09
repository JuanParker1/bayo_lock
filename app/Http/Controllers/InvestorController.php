<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index()
    {
        $investors = Investor::all();
        return view('investor.index')->with([
            'investors' => $investors
        ]);
    }

    public function create()
    {
        return view('investor.create');
    }

    public function store(Request $request)
    {
        Investor::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'telefon' => $request->get('telefon'),
        ]);
    }

    public function showContracts($investor_id)
    {
        $investor = Investor::find($investor_id);

        return view('investor.contracts')
            ->with([
                'contracts' => $investor->contracts,
                'investor' => $investor,
            ]);
    }

    public function createContract($investor_id)
    {
        $investor = Investor::find($investor_id);

        if (empty($investor)) return false;
        $contract = Contract::create([
            'order' => 1,
            'status' => 1,
        ]);
        $investor->contracts()->attach($contract);

        return redirect("/investor/{$investor_id}/contracts");
    }
}
