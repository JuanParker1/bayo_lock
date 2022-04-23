<div>
    @if($trades !== null)
        <section wire:poll.60s="refreshPrices">

            @foreach($trades as $trade)
                <div class="trade-viewer">
                    <!-- tr wrappes all .card-block -->
                    <div class="card-wrapper">

                        <!-- currency -->
                        <div class="block-box {!! $collapseClasses[$trade['cryptoId']] !!}">
                            <div class="block as-column">
                                <div class="block-child">
                                    <img src="{{ $trade['img']['small'] }}">
                                </div>
                                <div class="block-child">
                                    <h3>{!! $trade['name'] !!}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- crypto amount -->
                        <div class="block-box {!! $collapseClasses[$trade['cryptoId']] !!}">
                            <div class="block">
                                <div class="block-child seperation">Amount</div>
                                <div class="block-child seperation">{!! round($trade['summed'],3) !!} pcs.</div>
                            </div>
                        </div>

                        <!-- current price -->
                        <div class="block-box {!! $collapseClasses[$trade['cryptoId']] !!}">
                            <div class="block">
                                <div class="block-child seperation">
                                    <span>Balance</span>
                                </div>
                                <div class="block-child seperation">
                            <span>
                                {!! round($tradesLiveBalance[$trade['cryptoId']]['percentage'],2) !!}%
                            </span>
                                </div>
                                <div class="block-child seperation">Price</div>
                                <div class="block-child seperation">
                            <span>
                                {!!  round($tradesLivePrices[$trade['cryptoId']]['eur'],2) * $trade['summed'] !!}€
                            </span>
                                </div>
                            </div>
                        </div>

                        <!-- action button -->
                        <div class="card-block-actions {!! $collapseClasses[$trade['cryptoId']] !!}">
                            {{-- Edit --}}
                            <div class="action icon" wire:click="decrease('{{ $trade["id"] }}')">
                                <i class="bi bi-plus-slash-minus"></i>
                            </div>

                            {{-- Bin --}}
                            <div class="action icon"
                                 wire:click.prevent="delete('{{ implode(',',$trade['collectiveIds']) ?? $trade['id'] }}')">
                                <i class="bi bi-trash3"></i>
                            </div>

                            @if($trade['isCollective'])
                                {{-- collection --}}
                                <div class="action icon btn{{ $trade['name'] }}"
                                     wire:click="extend( '{{ $trade['cryptoId'] }}' )">
                                    <i class="bi bi-collection"></i>
                                </div>
                            @else
                                {{-- Info --}}
                                <div class="action icon" wire:click="openModal">
                                    <i class="bi bi-info"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    @if($showCollective[$trade['cryptoId']] == true)
                        <livewire:show-trade-childern :ids="$trade['collectiveIds']"/>
                    @endif
                </div>
                {{-- modal --}}
                @if($openModal)
                    {{--            <livewire:trade-modal :trade="$trade" :currentBalance="$tradesLiveBalance" :currentPrice="$currentPrice" />--}}
                @endif
                {{-- edit modal --}}
                @if($editAble)
                    {{--            <livewire:update-trade :wire:key="'update-'.$trade['id']" :tradeId="$trade['id']" :orderDay="$trade['orderDay']" :summed="$trade['summed']" :img="$trade['img']['large']"/>--}}
                @endif
            @endforeach
        </section>
    @endif
</div>
