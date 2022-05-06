<div>
    <div class="create-container h-full">
        {{-- search-result --}}
        @include('/Components/FormElements/TradeCreateElements/trade-result-area',['searchResult' => $results])

        {{--  header  --}}
        @include('/Components/FormElements/TradeCreateElements/trade-header-user-guid',
                [
                    'top' => 'Where is your ',
                    'middle' => 'currency',
                    'bottom' => 'actually stored'
                ])

        {{-- Search Area --}}
        @include('/Components/FormElements/SearchArea/big-search-input',[
            'placeholder' => 'type markt or wallet name to start the search...',
            'searchFor' => 'market'
        ])
    </div>

    {{--  button  --}}
    <div class="action-btn-area">
        @include('/Components/FormElements/Buttons/back-next-store',[
            'back' => 'back',
            'actionLabel' => 'store',
            'actionFunction' => "store('market-wallet')"
        ])
    </div>
</div>
