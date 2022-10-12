@extends('layouts/contentLayoutMaster')


@section('title', 'Comisiones')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    {{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection
<style>
    .fw-700 {
        font-weight: 700 !important;
    }

    .labelW {
        font-weight: 600;
        color: #47586C;
    }

    @media screen and (max-width: 901px) and (min-width:768px) {
        .mb-24 {
            margin-bottom: 24px !important;
        }
    }

    @media (max-width:767px) {
        .col-md-4.col-sm-6 {
            margin-bottom: 2rem;
        }
    }

    @media (max-width:330px) {}

    .zoom {
        transition: transform .2s;
    }

    .zoom:hover {
        transform: scale(1.15);
    }

    .zoom:active {
        transform: scale(1);
    }
</style>
@section('content')
    @include('business.componentes.Js.Js')
    @include('business.componentes.CSS.styles')

    <div class="d-flex my-1 justify-content-between flex-wrap">
        <div class="d-flex align-items-center flex-wrap">

            <p class="fw-700 mb-0">Billetera</p><span class="fw-300 mx-1 text-light">|</span>
            <p class="fw-500 mb-0 text-primary">Retiro</p>
            <i data-feather='chevron-right' class="text-light mx-75"></i>
            <p class="fw-400 mb-0">Solicitar Retiro</p>

        </div>
        <a type="button" class="btn border-primary ms-auto text-primary mt-1" href="{{ route('retiros') }}"><i
                class="fas fa-arrow-left"></i> Volver</a>
    </div>

    <!-- Statistics card section -->
    <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item me-2 zoom" role="presentation">
                <div class=" active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">
                    <div class="card p-1">
                        <div class="avatar bg-light-primary avatar-md me-auto mb-1 custom-avatar-content p-50">
                            <div class="avatar-content">
                                <svg width="21" height="18" viewBox="0 0 21 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1.39146 4.28V2C1.39146 0.9 2.32911 0 3.47513 0H18.0609C19.2173 0 20.1445 0.9 20.1445 2V16C20.1445 17.1 19.2173 18 18.0609 18H3.47513C2.32911 18 1.39146 17.1 1.39146 16V13.72C0.776775 13.37 0.349623 12.74 0.349623 12V6C0.349623 5.26 0.776775 4.63 1.39146 4.28ZM2.4333 6V12H9.72616V6H2.4333ZM18.0609 16V2H3.47513V4H9.72616C10.8722 4 11.8098 4.9 11.8098 6V12C11.8098 13.1 10.8722 14 9.72616 14H3.47513V16H18.0609Z"
                                        fill="#673DED" />
                                </svg>
                            </div>
                        </div>
                        <div class="texto">
                            <h3 class="fw-700 mb-25">USDT {{ number_format($balance, 2) }} </h3>
                            <p class="font-medium-2 mb-0">Saldo Disponible para Retirar</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('business.ui.componentes.tipos-retiros.comisiones.comisiones')
            </div>
        </div>

    </div>



    <!--/ Statistics Card section-->

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
            responsive: true,
            order: [
                [0, 'desc']
            ],
            pagingType: 'simple_numbers',
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
        })
    </script>

    <script>
        function requestWithdrawal() {
            const buttonSend = document.getElementById('continue-button')
            buttonSend.disabled = true
            const form = document.getElementById('form-withdrawal')
            form.submit()
        }

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
