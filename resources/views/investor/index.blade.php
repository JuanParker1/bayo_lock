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
    <table>
        <thead>
        <th>name</th>
        </thead>
        <tbody>
        @foreach($investors as $investor)
            <tr>
                <td>
                    <a href="/investor/{!! $investor->id !!}">
                        {!! $investor->firstname . ' ' . $investor->lastname !!}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
