@extends('layouts.app')

@section('content')
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
    <div>
        <a href="/investor/{!! $investor->id !!}/create-contract">create new contract</a>
    </div>
    <table>
        <thead>
        <th>order</th>
        <th>status</th>
        <th>amount of paymanet</th>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td>
                    <a href="/investor/{!! $contract->id !!}/contracts">
                        {!! (int)$contract->order  !!}
                    </a>
                </td>
                <td>{!! (int)$contract->status == 1 ? 'Aktiv' : 'Inaktiv'  !!}</td>
                <td>{!! $contract->deposits->sum('amount') !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
