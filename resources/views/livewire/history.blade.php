<div>
    <div wire:click="previous({{$element['id']}},'Purchase')">
        {{ $element['crypto_id'] }}
        {{ $element['amount'] }}
    </div>
    @if(count($previousElements) > 0)
        <h6>Kauf Historie:</h6>
        @foreach($previousElements as $key => $elements)
            @if($key === 'transaktions')
                <div>
                    @foreach($elements as $element)
                        <span>verschickte Menge: {{ $element->amount }}</span>
                        <span>angefallene Gebühren: {{ $element->fees }}</span>
                        <span>verschickt von: {{ $element->where }}</span>
                        <span>verwendetes Netwerk: {{ $element->network }}</span>
                    @endforeach
                </div>
            @endif

            @if($key === 'purchases')
                <div>
                    @foreach($elements as $element)
                        <span>verschickte Menge: {{ $element->amount }}</span>
                        <span>angefallene Gebühren: {{ $element->fees }}</span>
                        <span>gekaufte crypto: {{ $element->crypto_id }}</span>
                        <span>preis 1x: {{ $element->purchase_price_euro }}</span>
                        <span>verwendeter Betrag: {{ $element->used_amount }}</span>
                        <span>kauf mittels: {{ $element->currency }}</span>
                    @endforeach
                </div>
            @endif

            @if($key === 'deposits')
                <div>
                    @foreach($elements as $element)
                        <span>verschickte Menge: {{ $element->amount }}</span>
                        <span>angefallene Gebühren: {{ $element->fees }}</span>
                        <span>gekaufte crypto: {{ $element->where }}</span>
                        <span>preis 1x: {{ $element->currency }}</span>
                    @endforeach
                </div>
            @endif

        @endforeach
    @endif
</div>
