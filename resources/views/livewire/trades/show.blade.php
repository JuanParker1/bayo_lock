<div>
    @if($ids)
        <link href="{{ asset('css/trade-childern.css') }}" rel="stylesheet">
        <center>
            <div class="-table">
                <div class="inline-block">
                    <div class="collective-children header">
                        Order date
                    </div>
                    <div class="collective-children header">
                        Amount
                    </div>
                    <div class="collective-children header">
                        Price
                    </div>
                    <div class="collective-children header">
                        Location
                    </div>
                </div>

                {{--     table body --}}
                @foreach($collective as $element)
                    <div class="inline-block collective-row">

                        <div class="collective-children body">
                            {!! date('d M. Y' ,strtotime($element["order-day"])) !!}
                        </div>
                        <div class="collective-children body">
                            {!! $element["total-currency"] !!}
                        </div>
                        <div class="collective-children body">
                            {!! $element['currency-single-price'] * $element["total-currency"] !!} Eur.
                        </div>
                        <div class="collective-children body">
                            <span class="full-width" wire:click="openModal('{{ $element['id'] }}')"></span>
                            {{ $element->location->name }}
                        </div>

                    </div>
                @endforeach

                {{--     table footer --}}
                <div class="inline-block">
                    <div class="collective-children footer"></div>
                    <div class="collective-children footer"></div>
                    <div class="collective-children footer"></div>
                    <div class="collective-children footer"></div>
                </div>
            </div>
        </center>
    @endif
</div>
