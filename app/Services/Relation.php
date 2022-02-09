<?php

namespace App\Services;

use App\Models\ParentChild;

class Relation
{
    public function __construct()
    {
        $this->tail = 'App\Models\model';
    }

    public function getParent($element, $portfolio_id)
    {
        return ParentChild::where('child', '=', json_encode($element))
            ->get();
    }

    public function getPrevious($object)
    {
        // get parent
        // then get all previous
        $array = [];
        $element = ParentChild::where('child', '=', json_encode($object))->first();
        $parent = $element['parent'];

        do {
            $toSearchChild = ParentChild::where('child', '=', $element['previous'])
                ->where('parent', '=', $element['parent'])
                ->first();

            $element = $toSearchChild;
            if ($toSearchChild !== null) {
                $queryElement = $this->getElement($toSearchChild['child']);

                // get table name, if needed set tablename as empty array
                if(!isset($array[$queryElement->getTable()])) $array[$queryElement->getTable()] = [];
                array_push($array[$queryElement->getTable()],$queryElement);
            }

        } while ($toSearchChild['parent'] === $parent);

        //add parent to array
        $parent = $this->getElement($parent);
        if(!isset($array[$parent->getTable()])) $array[$parent->getTable()] = [];
        array_push($array[$parent->getTable()],$parent);

        return $array;
    }

    public function getElement($queryElement)
    {
        $model = str_replace('model', $queryElement->model, $this->tail);
        return $model::find($queryElement->id);
    }
}
