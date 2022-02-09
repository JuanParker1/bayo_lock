<?php

namespace App\Http\Controllers;

use App\Services\Relation;

// ##### Models #####
use App\Models\Historie;
use App\Models\ParentChild;
use App\Models\Portfolio;

class testController extends Controller
{
    private $relation;

    public function __construct()
    {
        $this->relation = new Relation();
    }

    public function index()
    {
        $relation = new Relation();
        $queryHistorie = Historie::all()->toArray();
        $sampler = [];

        foreach ($queryHistorie as $historie) {
            if (strpos($historie['element'], 'Purchase')) {
                array_push($sampler, $relation->getElement($historie['element']));
            }
        }

        return view('historie.index')
            ->with(['histories' => $sampler]);
    }

    public function getParent($element)
    {
        $childern = ParentChild::where('parent', '=', json_encode($element))
            ->get();

        foreach ($childern as $child) {
            $element = $child['child'];
            dump($element);
        }
    }

    public function portfolio()
    {
        // declare variable:
        $portfolioSampler = [];
        //user id verweist auf das portfolio
        $cryptos = Portfolio::find(1)->cryptos;

        // hole dir alle ein träge mit nur währungen
        foreach ($cryptos as $crypto) {
            if (!in_array($crypto->element->model, ['Purchase'])) continue;
            $queryResult = $this->relation->getElement($crypto->element);
            if ($queryResult->amount) {
                array_push($portfolioSampler,$queryResult);
            }
        }
        return view('historie.showPortfolio')->with(['cryptos' => $portfolioSampler]);
    }
}
