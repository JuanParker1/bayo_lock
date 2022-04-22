<div class="blur-container" wire:click.prevent="$emitUp('closeModal')">
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
