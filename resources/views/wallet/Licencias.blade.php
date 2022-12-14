<div class="tab-pane fade show" id="license" role="tabpanel" aria-labelledby="nav-licen-tab">
    <div class="contenedor tres-columnas ">
        <div class="card p-2 entrada-bloc">
            <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                <div class="avatar-content">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                            fill="#04D99D" />
                    </svg>
                </div>
            </div>

            <div class="texto" style="padding-left: 3%">
                @if (isset($licenciasTotal ))
                    <span style="font-weight:900; font-size: 21px">USDT {{$licenciasTotal }} </span>
                @else
                    <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                @endif
                <br>
                <span class="text-light">Total Ganado</span>
            </div>
        </div>
        <div class="card p-2 entrada-bloc">
            <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                <div class="avatar-content">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                            fill="#04D99D" />
                    </svg>
                </div>
            </div>

            <div class="texto" style="padding-left: 3%">
                @if (isset($licenciasAvailable ))
                    <span style="font-weight:900; font-size: 21px">USDT {{$licenciasAvailable }} </span>
                @else
                    <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                @endif
                <br>
                <span class="text-light">Saldo Disponibles</span>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-12">
        <div id="logs-list">
            <div class="col-12">
                <div class="card p-2">
                    <div class="card-content">
                        <div class="card-header my-1 p-0">
                            <h4 class="fw-700">Licencias</h4>
                            {{--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transferLicencias">
                                Transferir
                            </button>--}}
                        </div>
                        <div class="card-body card-dashboard p-0">
                            <div class="table-responsive">
                                <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                    <thead class="">
                                        <tr class="text-center">
                                            <th>Monto</th>
                                            <th>Puntos</th>
                                            <th>Estado</th>
                                            <th class="d-none d-sm-table-cell">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($licencias  as $licen)
                                            <tr class="text-center">
                                                <td> {{ number_format($licen->amount, 2) }}</td>
                                                <td> {{ $licen->amount * 5 }}</td>
                                                <td>
                                                    @if ($licen->status == '0')
                                                        <span class="badge bg-info">Disponible</span>
                                                    @elseif($licen->status == '1')
                                                        <span class="badge bg-warning">Solicitada</span>
                                                    @elseif($licen->status == '2')
                                                        <span class="badge bg-success">Pagado</span>
                                                    @elseif($licen->status == '3')
                                                        <span class="badge bg-danger">Anulada</span>
                                                    @elseif($licen->status == '4')
                                                        <span class="badge bg-danger">Sustraida</span>
                                                    @endif
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {{ date('d-m-Y', strtotime($licen->created_at))
                                                }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('wallet.components.transfer-licencias')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
