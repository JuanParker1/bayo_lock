<div class="create-container h-full">
    {{-- search-result --}}
    @include('/Components/FormElements/TradeCreateElements/trade-result-area',['searchResult' => $results])

    {{--  header  --}}
    @include('/Components/FormElements/TradeCreateElements/trade-header-user-guid',
            [
                'top' => 'Search for',
                'middle' => 'your currency',
                'bottom' => 'Trade'
            ])

    {{-- Search Area --}}
    @include('/Components/FormElements/SearchArea/big-search-input',[
        'placeholder' => 'type currency name to start the search...',
        'searchFor' => 'search'
    ])
</div>
