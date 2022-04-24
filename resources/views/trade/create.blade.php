@extends('layouts.app')

@section('content')
    <livewire:create-trades :contract_id="$contract_id"/>
@endsection
