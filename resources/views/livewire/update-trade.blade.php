<div>
    <div class="blur-container" wire:click.prevent="$emitUp('closeEditModal')">
        <form wire:submit.prevent="update">
            <div class="block">
                <div class="block-modal" wire:click.stop="">

                    <div class="modal-edit-layout">
                        <div class="modal-header">
                            <div class="modal-icon img">
                                <img src="{{$img}}">
                            </div>
                            <div class="modal-header-text">
                                {{ $modelTrade->cryptocurrency->name }}
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="modal-body-header">
                                <div class="modal-edit-header">current values</div>
                                <div class="modal-edit-header">to change values</div>
                            </div>

                            <div class="modal-body-content">
                                {{-- date --}}
                                <div class="modal-body-tr">
                                    <div class="modal-edit-body">
                                        <div class="edit-body-icon x-large">
                                            <i class="bi bi-calendar-week"></i>
                                        </div>
                                        <div class="edit-body-text large">
                                            {{ date('d M. Y G:i' ,strtotime($modelTrade['order-day'])) }}
                                        </div>
                                    </div>

                                    <div class="modal-edit-body">
                                        <div class="edit-body-icon x-large">
                                            <i class="bi bi-pen"></i>
                                        </div>
                                        <div class="edit-body-text large item-input">
                                            <input wire:model="formOrderDay" type="datetime-local" value="{{$orderDay}}">
                                            @if($formMessageOrderDay)
                                                <livewire:form-message :message="$formMessageSummed" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- currency --}}
                                <div class="modal-body-tr">
                                    <div class="modal-edit-body">
                                        <div class="edit-body-icon x-large">
                                            <i class="bi bi-stack"></i>
                                            <sub>Amount</sub>
                                        </div>
                                        <div class="edit-body-text large">
                                            {{ $summed }}
                                            @if($formSummed > 0)
                                                <sub>it remains {{ $sum }}</sub>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="modal-edit-body">
                                        <div class="edit-body-icon x-large">
                                            <i class="bi bi-pen"></i>
                                            <sub>enter the number which has to be reduced</sub>
                                        </div>
                                        <div class="edit-body-text large item-input">
                                            <input wire:model="formSummed" inputmode="numeric" type="number" step="any" placeholder="{{ $summed }}">
                                            @if($formMessageSummed)
                                                <livewire:form-message :message="$formMessageSummed" />
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer trade-btn-area">
                            <div class="item">
                                <button class="btn-action btn-back">return</button>
                            </div>
                            <div class="item">
                                <button class="btn-action btn-store">store</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
