<div>
    <div class="width-10-percent">
        <div class="block">
            <div class="block-child seperation {!! $preferredFiat === 'eur' ? 'highlight' : 'discreet' !!}" wire:click="toggle('eur')">euro</div>
            <div class="block-child seperation {!! $preferredFiat === 'usd' ? 'highlight' : 'discreet' !!}" wire:click="toggle('usd')">usd</div>
        </div>
    </div>
</div>
