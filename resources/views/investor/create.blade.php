@extends('layouts.app')

@section('content')
    <form action='/investor/create' method='post'>
        @csrf
        <div>
            <label>firstname</label>
            <input name='firstname' type='text'>
        </div>

        <div>
            <label>lastname</label>
            <input name='lastname' type='text'>
        </div>

        <div>
            <label>telefon</label>
            <input name='telefon' type='tel'>
        </div>

        <input type='submit' value='submit'>
    </form>
@endsection
