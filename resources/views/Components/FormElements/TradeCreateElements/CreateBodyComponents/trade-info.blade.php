<div class="create-container h-full">
    {{--  header  --}}
    @include('/Components/FormElements/TradeCreateElements/trade-header-user-guid',
            [
                'top' => 'Order',
                'middle' => 'details for',
                'bottom' => $coin["name"]
            ])
    {{--  search header result  --}}
    <div class="search-result"></div>

    <div class="trade-search-area">
        <div class="filler">
            <div class="item seperation">
                <div class="item-label">
                    <h3>Order date</h3>
                </div>
                <div class="item-input">
                    <input wire:model="orderDay" type="datetime-local"/>
                </div>
            </div>

            <div class="item seperation">
                <div class="item-label">
                    <h3>Total Currency</h3>
                </div>
                <div class="item-input">
                    <input wire:model="currencyTotal" type="number" accept="any"/>
                </div>
            </div>

            <div class="item seperation">
                <div class="item-label">
                    <h3>Price</h3>
                </div>
                <div class="item-input">
                    <input wire:model="currencyPrice" type="number" accept="any"/>
                </div>
            </div>


        </div>
    </div>

    {{--  button  --}}
    <div class="action-btn-area">
        @include('/Components/FormElements/Buttons/back-next-store',[
            'back' => 'back',
            'actionLabel' => 'next',
            'actionFunction' => 'next'
        ])
    </div>

</div>
