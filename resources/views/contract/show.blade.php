@extends('layouts.app')

@section('content')
    <a href="/contract/{!! $contract->id !!}/create-trade">create new trade</a>
    {{--    <livewire:show-currency :contract_id="$contract->id"/>--}}
    @foreach($trades as $trade)
        <livewire:show-trades :trade="$trade" :wire:key="$trade['id']"/>
    @endforeach
@endsection
