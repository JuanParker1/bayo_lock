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
        <a href="/contract/create">create new contract</a>
    </div>
    <table>
        <thead>
        <th>order</th>
        <th>status</th>
        <th>amount of paymanet</th>
        <th>action</th>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td>
                    <a href="/contract/{!! $contract->id !!}">
                        {!! (int)$contract->order  !!}
                    </a>
                </td>
                <td>{!! (int)$contract->status == 1 ? 'Aktiv' : 'Inaktiv'  !!}</td>
                <td>{!! $contract->deposits->sum('amount') !!}</td>
                <td>
                    <a href="/contract/{!! $contract->id !!}/{!! $investor->id !!}/extend">extend contract</a>
                    <form action="/contract/{!! $contract->id !!}/{!! $investor->id !!}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

