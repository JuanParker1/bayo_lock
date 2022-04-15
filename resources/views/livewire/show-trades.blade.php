<div>
    <style>
        .item1 {
            grid-area: empty;
        }

        .icon {
            grid-area: icon;
        }

        .text {
            grid-area: text;
        }

        .card-block {
            display: grid;
            grid-template-areas:
            'empty empty empty empty'
            'icon icon clear clear'
            'text text text text';
            gap: 5px;
            padding: 25px;
        }

        .card-wrapper {
            display: flex;
            gap: 25px;
        }

        .action1 {
            grid-area: action1;
        }

        .action2 {
            grid-area: action2;
        }

        .action3 {
            grid-area: action3;
        }

        .action4 {
            grid-area: action4;
        }

        .card-block-actions {
            display: grid;
            grid-template-areas:
            'action1 action1 action2 action2'
            'action3 action3 action4 action4';
        }

        .card-block-actions, .card-block {
            /* figma style copied */
            min-width: 175px;
            height: 180px;
            box-shadow: 0px 10px 16px 0px rgb(0 0 0 / 20%);
            border-radius: 25px;
            position: relative;
            z-index: 1;
        }

        .card-block-multiple::after, .card-block-extend::after {
            content: '';
            border-bottom: 1px solid grey;
            width: 100%;
            height: 50px;
            position: absolute;
            bottom: -7px;
            border-radius: 25px;
        }

        .card-block-multiple::before {
            content: '';
            border-bottom: 1px solid grey;
            width: 100%;
            height: 50px;
            position: absolute;
            bottom: -14px;
            border-radius: 25px;
        }

        .trade-viewer {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-bottom: 45px;
        }
    </style>
    <div class="trade-viewer">
        <!-- tr wrappes all .card-block -->
        <div class="card-wrapper">

            <!-- single block! -->
            <div class="card-block {!! $tradeClass !!}">
                <div class="item1"></div>
                <div class="icon">
                    <img src="{{ $trade['img']['small'] }}">
                </div>
                <div class="text">
                    <h3>{!! $trade['name'] !!}</h3>
                </div>
                <div class="item1"></div>
            </div>

            <div class="card-block {!! $tradeClass !!}">
                <div class="item1"></div>
                <div class="icon">Order date</div>
                <div class="text">{!! date('d M. Y' ,strtotime($trade['orderDay'])) !!}</div>
                <div class="item1"></div>
            </div>

            <!-- crypto amount -->
            <div class="card-block {!! $tradeClass !!}">
                <div class="item1"></div>
                <div class="icon">Amount</div>
                <div class="text">{!! round($trade['totalCurrency']) !!} amt.</div>
                <div class="item1"></div>
            </div>

            <!-- action button -->
            <div class="card-block-actions {!! $tradeClass !!}">
                <div class="action1">1</div>
                <div class="action2">2</div>
                <div class="action3">3</div>
                @if($trade['isCollective'])
                    <div class="action4">
                        <button wire:click="extend" class="btn{{ $trade['name'] }}">
                            show collective
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if($showCollective == true)
        <livewire:show-trade-childern :ids="$trade['collectiveIds']"/>
    @endif
</div>

