<?php

namespace App\Http\Livewire;

use App\Models\Trade;
use LivewireUI\Modal\ModalComponent;

class UpdateTrade extends ModalComponent
{
    public $tradeId;
    public $trade;
    public $sum;
    public $img;
    public $isCollective;

    // FORM ELEMENTS
    public $formOrderDay;
    public $formSummed = 0;

    // ERROR MESSAGE
    public $formMessageSummed;
    public $formMessageOrderDay;

    public function mount()
    {
        $this->trade = Trade::find($this->tradeId);
    }

    public function update()
    {
        //check if the number is smaller than the original
        if ($this->trade['total-currency'] < $this->formSummed) {
            $this->formMessageSummed = 'it has to be smaller than the total amount!';
            return false;
        }

        $trade = Trade::find($this->tradeId);

        if (!empty($this->formOrderDay)) {
            $trade['order-day'] = $this->formOrderDay;
        }

        $trade['total-currency'] = $this->trade['total-currency'] - $this->formSummed;

        $trade->update();

        // if total-currency is equal to zero, delete whole trade.
        if ($trade['total-currency'] === 0) {
            $trade->delete();
        }

        $this->emitUp('closeEditModal');
    }

    public function render()
    {
//        if ($this->trade['total-currency'] < $this->formSummed) {
//            $this->formMessageSummed = 'it has to be smaller than the total value!';
//        }
//
//        if ($this->formSummed > 0) {
//            $this->sum = $this->trade['total-currency'] - $this->formSummed;
//        }

        return view('livewire.update-trade');
    }
}
