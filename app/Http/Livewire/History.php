<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\Relation;

class History extends Component
{
    public $element;
    public $relation;
    public $previousElements = [];

    public function mount($element)
    {
        $this->element = $element;
    }

    public function previous($id, $model)
    {
        $relation = new Relation();
        $this->previousElements = $relation
            ->getPrevious(["model" => $model, "id" => $id]);
    }

    public function render()
    {
        return view('livewire.history');
    }
}
