<div class="tab-pane fade show" id="general" role="tabpanel" aria-labelledby="nav-licen-tab">
    <div class="contenedor tres-columnas ">
        <div class="card p-2 entrada-bloc">
            <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                <div class="avatar-content">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                            fill="#673DED" />
                    </svg>
                </div>
            </div>

            <div class="texto" style="padding-left: 3%">
                @if (isset( $generalTotal ))
                    <span style="font-weight:900; font-size: 21px">USDT {{ $generalTotal }} </span>
                @else
                    <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                @endif
                <br>
                <span class="text-light">Total de comisiones pasivas</span>
            </div>
        </div>
        <div class="card p-2 entrada-bloc">
            <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                <div class="avatar-content">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                            fill="#673DED" />
                    </svg>
                </div>
            </div>

            <div class="texto" style="padding-left: 3%">
                @if (isset( $generalAvaliable ))
                    <span style="font-weight:900; font-size: 21px">USDT {{ $generalAvaliable }} </span>
                @else
                    <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                @endif
                <br>
                <span class="text-light">Total de comisiones Disponibles</span>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-12">
        <div id="logs-list">
            <div class="col-12">
                <div class="card p-2">
                    <div class="card-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="fw-700">General</h4>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end">Solicitar Retiro</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalWallet" class="btn btn-gradient-primary float-end ms-1">Enlazar Wallet</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body card-dashboard p-0">
                            <div class="table-responsive">
                                <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                    <thead class="">
                                        <tr class="text-center">
                                            <th class="d-none d-sm-table-cell">ID</th>
                                            <th>Descripcion</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $general  as $gen)
                                            <tr class="text-center">
                                                <td class="d-none d-sm-table-cell">{{$gen->id}}</td>
                                                <td> {{ $gen->description }}</td>
                                                @if ($gen->type == 0)
                                                    <td class="text-success"> {{ number_format($gen->amount, 2) }}</td>
                                                @elseif($gen->type == 6)
                                                    <td class="text-success"> {{ number_format($gen->amount, 2) }}</td>
                                                @else
                                                    <td class="text-success"> {{ number_format($gen->amount, 2) }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @include('business.componentes.Modal.Retiros.setWalletModal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
