@extends('layouts.app')

@section('content')
    <livewire:create-update-contract :action="'extend'" :contractId="$contract->id" :investorId="$investor->id"/>
@endsection
