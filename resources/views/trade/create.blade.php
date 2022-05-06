@extends('layouts.app')

@section('content')
    <livewire:trades.create :contract_id="$contract_id"/>
@endsection
