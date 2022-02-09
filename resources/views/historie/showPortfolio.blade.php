<table>
    <thead>
        <th>währung</th>
        <th>betrag</th>
        <th>währung</th>
        <th>name</th>
    </thead>
    <tbody>
    @foreach($cryptos as $crypto)
        <tr>
            <th>{!! $crypto['crypto_id'] !!}</th>
            <th>{!! $crypto['used_amount'] !!}</th>
            <th>{!! $crypto['currency'] !!}</th>
            <th>{!! $crypto['crypto_id'] !!}</th>
        </tr>
    @endforeach
    </tbody>
</table>
