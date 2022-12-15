@extends('layouts/contentLayoutMaster')

{{-- @push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/js/withdraw.js')}}"></script>
@endpush --}}


@section('title', 'Comisiones')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
{{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')
<style type="text/css">
    .contenedor {
        max-width: 1300px;
        width: 100%;
        margin: 0 auto;
    }

    .entrada-blog a {
        display: inline-block;
        color: white;
        padding: 10px 10px;
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;
    }


    @media (min-width: 768px) {

        .tres-columnas {
            display: grid;
            grid-template-columns: repeat(3, 25%);
            column-gap: 2rem;
        }
    }

    .entrada-bloc a {
        display: inline-block;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
    }

    .ajust-icon {
        width: 65%;
        height: 65%;
    }

    .fw-700 {
        font-weight: 700 !important;
    }
    .nav-text{
        color: #68676e !important;
        font-size: 14px;
        font-weight: bold;
    }

    .usdt-color{
        color: #04D99D;
    }

    .success-badge{
        background-color: rgba(66, 172, 70, 0.16);
    }
    .success-text{
        color: #42AC46;
    }
    .waiting-text{
        color: #36D9ED;
    }
    .waiting-badge{
        background-color: #D6F7FB;
    }
    .warning-badge{
        background-color: #FBE3E4;
    }
    .warning-text{
        color: #FF4969;
    }
    .cebra{
        background-color: #D8EDED;
    }
</style>
<div class="d-flex my-2">
    <p style="color:#808E9E;" class="fw-700">Billetera</p><span class="fw-normal mx-1">|</span>
    <p>Billetera</p>
</div>

<nav class="col-sm-12 lista">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-rentability-tab" data-bs-toggle="tab" data-bs-target="#general"
        type="button" role="tab" aria-controls="nav-rentability" aria-selected="false"><span class="nav-text">General</span> </button>

        <button class="nav-link" id="nav-rentability-tab" data-bs-toggle="tab" data-bs-target="#license"
        type="button" role="tab" aria-controls="nav-rentability" aria-selected="false"><span class="nav-text">Licencias</span></button>

        <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
        role="tab" aria-controls="nav-home" aria-selected="true"><span class="nav-text">MLM PAMM</span></button>

        {{-- <button class="nav-link" id="nav-range-tab" data-bs-toggle="tab" data-bs-target="#nav-range" type="button"
        role="tab" aria-controls="nav-range" aria-selected="false">Balance en cuenta PAMM </button> --}}

    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
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
                    <span class="usdt-color" style="font-weight:900; font-size: 21px">USDT {{ $mlmTotal }} </span>
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
                    <span class="usdt-color" style="font-weight:900; font-size: 21px">USDT {{ $mlmAvailable }} </span>
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
                                <h4 class="fw-700">Comisiones</h4>
                                {{--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transferMlm">
                                    Transferir
                                </button>--}}
                            </div>
                            <div class="card-body card-dashboard p-0">
                                <div class="table-responsive">
                                    <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                        <thead class="">
                                            <tr class="text-center">
                                                <th>Monto</th>
                                                <th>Nivel</th>
                                                <th>Estado</th>
                                                <th class="d-none d-sm-table-cell">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mlm as $wallet)
                                            <tr class="text-center">
                                                <td>
                                                    {{ number_format($wallet->amount, 2, ',','.') }}
                                                </td>
                                                <td>{{ $wallet->level }}</td>
                                                <td>
                                                    @if ($wallet->status == '0')
                                                    <span class="badge bg-info">Disponible</span>
                                                    @elseif($wallet->status == '1')
                                                    <span class="badge bg-warning">Solicitada</span>
                                                    @elseif($wallet->status == '2')
                                                    <span class="badge bg-success">Pagada</span>
                                                    @elseif($wallet->status == '3')
                                                    <span class="badge bg-danger">Anulada</span>
                                                    @endif
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    {{ date('d-m-Y', strtotime($wallet->created_at)) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @include('wallet.components.transfer-mlm')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('wallet.Licencias')
        @include('wallet.range')
        @include('wallet.general')
    </div>

    @endsection

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

    <script>
        let span = document.getElementById('span');
        let enviar = 'Enviar';
        let enviado = 'Enviado';
        span.innerHTML = enviar;

        function sendCodeEmail() {
            let url = 'aprobarRetiro'
            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                    if (IsNumeric(response) == true) {
                        $('#idLiquidation').val(response)
                        span.innerHTML = enviado;
                        toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
                            "progressBar": true
                        });
                    } else {
                        toastr.error("El monto minimo de retiro es 60 usdt", '¡Error!', {
                            "progressBar": true
                        });
                    }
                }).catch(function(error) {
                    console.log(error);
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                })

        }

        function IsNumeric(val) {
            return Number(parseFloat(val)) === val;
        }

        //REESTAURA VALOR DE CAMPOS
        $("#restaurar").click(function() {
            setTimeout(function() {
                window.location = '{{ route('wallet.index') }}';
            });
        });
    </script>

    @endsection
