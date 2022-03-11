@extends('layouts.app')

@section('content')
    <form action='/contract/{!! $contract_id !!}/create-trade' method='post'>
        @csrf
        @include('Components.FormElements.input',['labelType' => 'text', 'labelTitle' => 'Kryptowährung','name' => 'currency','labelValue' => ''])
        @include('Components.FormElements.input',['labelType' => 'number', 'labelTitle' => 'einkauf Preis (einzel)','name' => 'currency-single-price','labelValue' => '','extra' => 'step="any"'])
        @include('Components.FormElements.input',['labelType' => 'text', 'labelTitle' => 'gekauft mit (währung)','name' => 'used-coin'])
        @include('Components.FormElements.input',['labelType' => 'number', 'labelTitle' => 'ausgegeben kaufwährung (menge)','name' => 'used-coin-size'])
        @include('Components.FormElements.input',['labelType' => 'number', 'labelTitle' => 'fees', 'name' => 'fees', 'extra' => 'step="any"'])
        @include('Components.FormElements.input',['labelType' => 'number', 'labelTitle' => 'erhaltene wunsch währung','name' => 'total-currency', 'extra' => 'step="any"',])
        @include('Components.FormElements.input',['labelType' => 'datetime-local', 'labelTitle' => 'wann wurde gekauft','name' => 'order-day'])
        <input type="submit" value="save">
    </form>
@endsection
