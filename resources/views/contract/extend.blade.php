@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contract-extend.css') }}" rel="stylesheet">
   <x-contract-extend header="Extend Contract"/>
@endsection
