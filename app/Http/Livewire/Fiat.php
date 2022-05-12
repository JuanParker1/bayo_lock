<?php

namespace App\Http\Livewire;

use App\Models\UserPreference;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Fiat extends Component
{
    public $preferredFiat = 'eur';
    protected $listeners = ['getFiat'];

    public function toggle($fiat)
    {
        if ($this->preferredFiat === $fiat) return null;

        $this->preferredFiat = $fiat;
        $this->emitTo('trades.index', 'refreshFiat', $this->preferredFiat);
    }

    public function getFiat()
    {
        return $this->preferredFiat;
    }

    public function render()
    {
        return view('livewire.fiat');
    }
}
