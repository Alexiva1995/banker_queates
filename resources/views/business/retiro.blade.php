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

    @media only screen and (max-width: 600px) {
        .special {
            margin: 0 auto;
            width: 100%
        }
    }
</style>
@section('content')
    @include('business.componentes.Js.Js')
    @include('business.componentes.CSS.styles')

    <div class="d-flex my-1 justify-content-between flex-wrap">
        <div class="d-flex align-items-center flex-wrap">

            <p class="fw-700 mb-0">Wallet</p><span class="fw-300 mx-1 text-light">|</span>
            <p class="fw-500 mb-0 text-primary">Withdrawal</p>
            <i data-feather='chevron-right' class="text-light mx-75"></i>
            <p class="fw-400 mb-0">
                Request Withdrawal</p>

        </div>
        <a type="button" class="btn border-primary ms-auto text-primary mt-1" href="{{ route('retiro') }}"><i
                class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Statistics card section -->
    <div class="container">

        <ul class="nav nav-tabs" id="myTab" role="tablist" >
            <li class="nav-item zoom special" role="presentation">
                <div class="active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">
                    
                </div>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                @include('business.ui.componentes.tipos-retiros.comisiones.comisiones', [
                    'withdrawalSettings' => $withdrawalSettings,
                    'pin' => $pin
                ])
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
