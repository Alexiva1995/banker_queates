<div class="col-md-6">
    <div class="card p-2">
        <div class="card-body p-0">
            <h5 class=" fw-bolder">Historial de Bonos</h5>
            <div class="table-responsive">
                <table class="text-capitalize table nowrap scroll-horizontal-vertical row-border myTable  w-100">
                    <thead class="border-bottom">
                        <tr>
                            <th class="ps-1 d-none d-sm-table-cell">Fecha</th>
                            <th class="ps-1">Nombre</th>
                            <th class="ps-1">Ganancia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->wallets as $bonus)
                        <tr>
                            <td class="px-1 border-top d-none d-sm-table-cell">
                                {{ $bonus->created_at->format('d/m/Y H:i:s') }}
                            </td>
                            <td class="px-1 border-top">
                                {{ $bonus->description }}
                            </td>
                            <td class="px-1 border-top" style="text-align: right">
                                {{ number_format($bonus->amount, 2, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
