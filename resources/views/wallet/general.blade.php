<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="nav-licen-tab">
    <div class="contenedor">
        <div class="row">
            <div class="col-sm-3">
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
                        @if ($generalTotal > 0)
                            <span style="font-weight:600; font-size: 21px ">USDT  <span class="text-success">{{ number_format($generalTotal, 2, ',', ' ');  }} </span></span>
                        @else
                            <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                        @endif
                        <br>
                        <span class="text-light" style="font-size: 13px;">Total Ganado</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card p-2 entrada-bloc ">
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
                        @if ($generalAvailable > 0 )
                            <span style="font-weight:900; font-size: 21px">USDT <span class="text-success">{{ number_format($generalAvailable, 2, ',', ' '); }} </span></span>
                        @else
                            <span style="font-weight:900; font-size: 21px">USDT 0 </span>
                        @endif
                        <br>
                        <span class="text-light">Saldo Disponible</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-2 entrada-bloc ">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalWallet" class="btn btn-gradient-primary float-end ms-1 mb-2" style="width: 89%;"><span style="font-size: 1.1rem; font-weight: 600;">{{ auth()->user()->wallet != null ? 'Cambiar Wallet' : 'Enlazar Wallet'}}</span></button>
                    <div class="texto">
                        <div class="col-sm-12">
                            <div class="row justify-content-center" style="margin-bottom:3.6%;">
                                <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end" style=" width: 83%">Solicitar Retiro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <h1 class="fw-400" style="font-size: 17px">Ganancias</h1>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>Descripcion</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $general  as $gen)
                                     <tr class="text-center">
                                        <td> {{ $gen->description }}</td>
                                        <td> {{ number_format($gen->amount, 2) }}</td>
                                        <td>
                                            @if ($gen->status == '0')
                                                <span class="badge bg-info">Disponible</span>
                                            @elseif($gen->status == '1')
                                                <span class="badge bg-warning">Solicitada</span>
                                            @elseif($gen->status == '2')
                                                <span class="badge bg-success">Pagado</span>
                                            @elseif($gen->status == '3')
                                                <span class="badge bg-danger">Anulada</span>
                                            @elseif($gen->status == '4')
                                                <span class="badge bg-danger">Sustraida</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('business.componentes.Modal.Retiros.setWalletModal')
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <h1 class="fw-400" style="font-size: 17px">Retiros</h1>
                        </div>
                        {{--<div class="col-sm-6">
                            <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end">Solicitar Retiro</a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWallet" class="btn btn-gradient-primary float-end ms-1">Enlazar Wallet</button>
                        </div>--}}
                    </div>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>Descripcion</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $balancEdition  as $gen)
                                     <tr class="text-center">
                                        <td> {{ $gen->description }}</td>
                                        <td> {{ number_format($gen->amount, 2) }}</td>
                                        <td>
                                            @if ($gen->status == '0')
                                                <span class="badge bg-info">En Espera</span>
                                            @elseif($gen->status == '1')
                                                <span class="badge bg-success">Pagado</span>
                                            @elseif($gen->status == '2')
                                                <span class="badge bg-danger">Cancelado</span>
                                            @endif
                                        </td>

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

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    @endsection
    @section('page-script')
    <script></script>
    {{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
    <script>
        //datataables ordenes
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, 'desc']
            ],
            language: {
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando _PAGE_ de _PAGES_',
                infoEmpty: 'No hay registros para mostrar',
                "search": "Buscar:",
                "paginate": {
                    "next": " ",
                    "previous": " "
                },
            },
            pagingType: 'simple_numbers',
        })
    </script>
@endsection
