<div class="trade-search-result">
    <div class="trade-search-result-container">

        @forelse($searchResult as $coin)
            <div wire:click=""></div>
            <div class="search-result"
                 wire:click="selectedCoin('{{$coin->id}}','{{$coin->name}}','{{$coin->symbol ?? false}}','{{$coin->large}}')">

                <div class="search-result-icon">
                    <img src="{!! $coin->large ?? '' !!}">
                </div>

                <div class="search-result-text">
                    <div>
                        <span class="coin-name">{!! $coin->name ?? '' !!}</span>
                        <sub class="red">{!! $coin->symbol ?? '' !!}</sub>
                    </div>
                </div>

            </div>
        @empty
            <div class="search-result"></div>
        @endforelse

    </div>
</div>
