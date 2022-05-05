<div class="trade-btn-area">
    <div class="filler">
        <div class="item">
            @if($back)
            <button class="btn-action btn-back" wire:click.prevent="back">return</button>
            @endif
        </div>
        <div class="item"></div>
        <div class="item">
            <button class="btn-action btn-store" wire:click.prevent="{!! $actionFunction !!}">{!! $actionLabel !!}</button>
        </div>
    </div>
</div>
