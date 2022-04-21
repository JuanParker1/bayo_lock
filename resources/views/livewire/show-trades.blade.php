<div>
    @if($trade !== null)
        <div class="trade-viewer">
            <!-- tr wrappes all .card-block -->
            <div class="card-wrapper">

                <!-- currency -->
                <div class="block-box {!! $collapseClass !!}">
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
                <div class="block-box {!! $collapseClass !!}">
                    <div class="block">
                        <div class="block-child seperation">Amount</div>
                        <div class="block-child seperation">{!! round($trade['summed'],3) !!} pcs.</div>
                    </div>
                </div>

                <!-- current price -->
                <div class="block-box {!! $collapseClass !!}"
                     wire:poll.60s="refreshPrice('{{ $trade["cryptoId"] }}','{{ $trade["summed"] }}')">
                    <div class="block">
                        <div class="block-child seperation">
                            <span>Balance</span>
                        </div>
                        <div class="block-child seperation">
                            <span>
                            {!! round($currentBalance['percentage'],2) !!}%
                            </span>
                        </div>
                        <div class="block-child seperation">Price</div>
                        <div class="block-child seperation">
                            <span>
                            {!!  round($currentPrice,2) !!}€
                            </span>
                        </div>
                    </div>
                </div>

                <!-- action button -->
                <div class="card-block-actions {!! $collapseClass !!}">
                    {{-- Edit --}}
                    <div class="action icon" wire:click="decrease('{{ $trade["id"] }}')">
                        <i class="bi bi-plus-slash-minus"></i>
                    </div>

                    {{-- Bin --}}
                    <div class="action icon"
                         wire:click.prevent="delete('{{ implode(',',$trade['collectiveIds']) ?? $trade['id'] }}')">
                        <i class="bi bi-trash3"></i>
                    </div>

                    {{-- collection --}}
                    @if($trade['isCollective'])
                        <div class="action icon btn{{ $trade['name'] }}" wire:click="extend">
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
        @if($showCollective == true)
            <livewire:show-trade-childern :ids="$trade['collectiveIds']"/>
        @endif

        {{-- modal --}}
        @if($openModal)
            <div class="blur-container" wire:click.prevent="closeModal">
                <div class="block">

                    <div class="block-modal" wire:click.stop="">
                        <div class="block-modal-layout">

                            <div class="modal-icon icon">
                                <i class="bi bi-calendar-week"></i>
                            </div>

                            <div class="modal-date">
                                {{ date('d M Y', strtotime($trade['orderDay'])) }}
                            </div>
                            <div class="modal-content">content</div>

                            <div class="modal-currentPrice">
                                <div class="block">
                                    <div class="block-child seperation">Bought price</div>
                                    <div class="block-child seperation">
                                    <span>
                                        {!!  round($trade['currencySinglePrice'],2) !!}€
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-buyPrice">
                                <div class="block">
                                    <div class="block-child seperation">Current price</div>
                                    <div class="block-child seperation">
                                    <span>
                                        {!!  round($currentPrice,2) !!}€
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-percent">
                                <div class="block">
                                    <div class="block-child seperation">Balance</div>
                                    <div class="block-child seperation">
                                    <span>
                                        {!! round($currentBalance['percentage'],2) !!}%
                                    </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endif
        {{-- edit modal --}}
        @if($editAble)
            <livewire:update-trade :wire:key="'update-'.$trade['id']" :tradeId="$trade['id']" :orderDay="$trade['orderDay']" :summed="$trade['summed']" :img="$trade['img']['large']"/>
        @endif
    @endif
</div>

