<div class="trade-search-result">
    <div class="trade-search-result-container">

        @forelse($searchResult as $coin)
            <div wire:click=""></div>
            <div class="search-result"
                 wire:click="selectedCoin('{{ $coin->id ?? false }}','{{ $coin->name ?? false }}','{{ $coin->symbol ?? false }}','{{ $coin->large ?? false}}')">

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
            <div class="search-result">
                @if(!empty($message))
                    <h3>{!! $message !!}</h3>
                @endif
            </div>
        @endforelse

    </div>
</div>
