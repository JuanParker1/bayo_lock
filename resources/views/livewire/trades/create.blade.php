<div>
    <link href="{{ asset('css/trade-create.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <form wire:submit.prevent="store">
        @include('/Components/FormElements/TradeCreateElements/CreateBodyComponents/'. $pagination['current'])
    </form>
</div>
