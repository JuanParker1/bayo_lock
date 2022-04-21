<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Trade;

class UpdateTrade extends Component
{
    public $tradeId;
    public $orderDay;
    public $summed;
    public $img;
    public $modelTrade;
    public $sum;

    // FORM ELEMENTS
    public $formOrderDay;
    public $formSummed = 0;

    // ERROR MESSAGE
    public $formMessageSummed;
    public $formMessageOrderDay;

    public function mount()
    {
        $this->modelTrade = Trade::find($this->tradeId);
    }

    public function update()
    {
        //check if the number is smaller than the original
        if ($this->summed < $this->formSummed) {
            $this->formMessageSummed = 'it has to be smaller than the total amount!';
            return false;
        }

        $trade = Trade::find($this->tradeId);

        if (!empty($this->formOrderDay)) {
            $trade['order-day'] = $this->formOrderDay;
        }

        $trade['total-currency'] = $this->summed - $this->formSummed;

        $trade->update();

        // if total-currency is equal to zero, delete whole trade.
        if ($trade['total-currency'] === 0) {
            $trade->delete();
        }

        $this->emitUp('closeEditModal');
    }

    public function render()
    {
        if ($this->summed < $this->formSummed) {
            $this->formMessageSummed = 'it has to be smaller than the total value!';
        }

        if ($this->formSummed > 0) {
            $this->sum = $this->summed - $this->formSummed;
        }

        return view('livewire.update-trade');
    }
}
