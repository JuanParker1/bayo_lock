@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/show-trades.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal-edit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trade-create.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    {{--    <livewire:show-currency :contract_id="$contract->id"/>--}}

    <div class="trade-header">
        <div class="block">
            <a href="/contract/{!! $contract->id !!}/create-trade" class="chapter-link padding-25 no-mark">
                <div class="block-child x-large">
                    <i class="bi bi-plus-lg"></i>
                </div>
                <div class="block-child">
                    create
                </div>
            </a>
        </div>
        {{--        <a href="/contract/{!! $contract->id !!}/create-trade">create new trade</a>--}}
    </div>
    {{--    @foreach($trades as $trade)--}}
    {{--        <livewire:show-trades :trade="$trade"/>--}}
    {{--    @endforeach--}}

    {{--  übergebe alle ins controller anstatt einzel.  --}}
    <livewire:show-trades :trades="$trades"/>

@endsection
