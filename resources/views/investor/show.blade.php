@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/show-trades.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/case.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <div>
        <a href="/contract/create">create new contract</a>
    </div>
    <div class="filler as-column center">
        <center>
            @foreach($contracts as $contract)
                @include('Components.case', ['header' => 'Auftrag ' . (int)$contract->order, 'price' => $contract->deposits->sum('amount')])
                @include('Components.case', ['header' => 'Auftrag ' . (int)$contract->order, 'price' => $contract->deposits->sum('amount')])
            @endforeach
        </center>
    </div>
@endsection

