@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/show-trades.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal-style.css') }}" rel="stylesheet">
    {{--    <livewire:show-currency :contract_id="$contract->id"/>--}}

    <a href="/contract/{!! $contract->id !!}/create-trade">create new trade</a>
    @foreach($trades as $trade)
        <livewire:show-trades :trade="$trade"/>
    @endforeach

@endsection
