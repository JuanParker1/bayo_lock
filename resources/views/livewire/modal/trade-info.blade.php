<div>
    @if($showTradeInfo)
        <div class="blur-container" wire:click.prevent="$emit('closeModal', true)">
            <div class="block">

                <div class="block-modal" wire:click.stop="">
                    <div class="block-modal-layout">

                        <div class="modal-icon icon">
                            <i class="bi bi-calendar-week"></i>
                        </div>

                        <div class="modal-date">
                            {{ date('d M Y', strtotime($trade['orderDay'])) }}
                        </div>

                        {{-- Action --}}
                        @if($trade['isCollective'])
                            <div class="modal-action">
                                <div class="block">

                                    {{-- edit --}}
                                    <div class="block-child seperation ">
                                        <div class="xx-large"
                                             wire:click="edit('{{ $trade["cryptoId"] }}')">
                                            <i class="bi bi-plus-slash-minus action"></i>
                                        </div>
                                    </div>

                                    {{-- Bin --}}
                                    <div class="block-child seperation">
                                        <div class="xx-large"
                                        wire:click.prevent="delete" >
                                            <i class="bi bi-trash3 action"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Content --}}
                        <div class="modal-content">
                            <div class="block">
                                <div class="block-child seperation">location</div>
                                <div class="block-child seperation">
                                    <span>
                                        {!!  $model->location->name !!}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-currentPrice">
                            <div class="block">
                                <div class="block-child seperation">Bought price</div>
                                <div class="block-child seperation">
                                    <span>
                                        {!!  round($trade['live']['price'] / $trade['summed'],2) !!} {!! $preferredFiatSymbol !!}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-buyPrice">
                            <div class="block">
                                <div class="block-child seperation">Current price</div>
                                <div class="block-child seperation">
                                    <span>
                                        @if(isset($livePrice))
                                        {!!  round($livePrice   ,2) !!} {!! $preferredFiatSymbol !!}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="modal-percent">
                            <div class="block">
                                <div class="block-child seperation">Balance</div>
                                <div class="block-child seperation">
                                    <span>
                                        @if(isset($liveBalance['percentage']))
                                        {!! round($liveBalance['percentage'],2) !!}%
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    @endif
</div>
