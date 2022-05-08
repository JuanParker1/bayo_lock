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
        // die nicht ausgesuchte bitte in grau hinterlegen, die ausgesuchte in blau
        $this->preferredFiat = $fiat;
        $this->emitTo('trades.index', 'refreshFiat', $this->preferredFiat);
        // speichere die ausgewählte fiat
        dump(Auth::user());
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
