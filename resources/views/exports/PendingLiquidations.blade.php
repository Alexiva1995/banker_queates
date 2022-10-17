<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>correo</th>
            <th>Monto Bruto</th>
            <th>Fee</th>
            <th>Monto a recibir</th>
            <th>wallet</th>
        </tr>
    </thead>
    <tbody>
        @foreach($liquidations as $liquidation)
            <tr>
                <td>{{ $liquidation->id }}</td>
                <td>{{ $liquidation->user->email }}</td>
                <td>{{ $liquidation->amount_gross }}</td>
                <td>{{ $liquidation->amount_fee }}</td>
                <td>{{ $liquidation->amount_net }}</td>
                <td>{{ $liquidation->decryptWallet() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>