<div>
    <form action='/contract/{!! $contract_id !!}/create-trade' wire:submit.prevent="store">
        @csrf

        <div>
            <label>Kryptowährung</label>
            <input wire:model="search" type="text" name="currency" placeholder="{{ $coin['name'] ?? '' }}">
            <div>
                @if(!empty($coins))
                    <ul>
                        @foreach($coins as $coin)
                            <li wire:click="neededCoin({{json_encode($coin)}})">{{$coin->name}}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div>
            <label>wert des einzelnen</label>
            <input type="number" value="" name="currency-single-price" step="any" wire:model="currencyPrice">
        </div>

        <div>
            <label>gekaufte Menge</label>
            <input type="number" value="" name="total-currency" step="any" wire:model="currencyTotal">
        </div>

        <div>
            <label>wann wurde gekauft</label>
            <input type="datetime-local" value="" name="order-day" required wire:model="orderDay">
        </div>
        <input type="submit" value="save">
    </form>
</div>
