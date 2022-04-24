<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $investors = Investor::all();
        return view('investor.index')->with([
            'investors' => $investors
        ]);
    }

    /**
     * @param $investor_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($investor_id)
    {
        $investor = Investor::find($investor_id);

        return view('investor.show')
            ->with([
                'contracts' => $investor->contracts,
                'investor' => $investor,
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
