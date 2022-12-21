@extends('layouts/contentLayoutMaster')

@section('title', 'Unilev1; i <= 4; i++ e { }l') @section('vendor-style') <link rel="stylesheet"
    href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('content')
    <style>
        .content-input input,
        .content-select select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .content-input input {
            visibility: hidden;
            position: absolute;
            right: 0;
        }
        .card{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
        .form-control{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
        .form-select{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
        .content-input {
            position: relative;
            display: block;
            cursor: pointer;
            width: 100px;
        }

        /* Estas reglas se aplicarán a todos los span despues de un input de tipo radio*/
        .content-input input[type=radio]+span {}

        .content-input input[type=radio]+span:before {
            background-color: #07B0F2;
            color: #fff;
        }

        .content-input input[type=radio]:checked+span {
            background: rgb(2,0,36);
            background: linear-gradient(90deg, #05A4EA, #02D6AC 100%);
            color: #fff;
            border-radius: 5px;
            opacity: 1;
        }

        /* .content-input:hover input[type=radio]:not(:checked)+span {
            background: #05A5E9;
            color: #fff;
            border-radius: 5px;
        } */

        .level-content {
            gap: 1rem;
            row-gap: 1.8rem;
            justify-content: flex-start;
        }

        .level {
            margin-right: 10px;
            font-size: 15px;
            font-weight: bold;
            padding: 10px 15px;
        }

        .active {
            background-color: #07B0F2;
            color: #fff;
            border-radius: 5px;
        }

        div.dataTables_wrapper div.dataTables_filter label,
        div.dataTables_wrapper div.dataTables_length label {
            margin-left: 15px;
        }


        .paginate_button.page-item:nth-child(2) {
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }
    </style>
    <div id="logs-list">
        <div class="d-flex my-1">
            <p class="fw-700 mb-0">Red</p><span class="fw-300 mx-1 text-primary">|</span>
            <p class="fw-400 mb-0">Unilevel</p>
        </div>
        <div class="card">
            <div class="card-content p-75">
                <div class="card-header d-block p-2 pb-0">
                    <div class="d-flex justify-content-between align-item-center flex-wrap  gap-50">
                        <h4 class="fw-700">Unilevel</h4>
                       
                    </div>
                </div>
            </div>
            <div class="tabs-wrapper px-2 mb-2">
                <div class="d-flex level-content flex-wrap mt-1">
                    <label class="d-flex text-nowrap content-input">
                        <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_1" value="1"
                            checked>
                        <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 1</span>
                        </input>
                    </label>
                    @if (2 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_2" value="2">
                            <span class="level">
                                <svg id="active_icon_2" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 2</span>
                        </label>
                    @endif
                    @if (3 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_3" value="3">
                            <span class="level">
                                <svg id="active_icon_3" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 3</span>
                        </label>
                    @endif
                    @if (4 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_4" value="4">
                            <span class="level">
                                <svg id="active_icon_4" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 4</span>
                        </label>
                    @endif
                    @if (5 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_5" value="5">
                            <span class="level">
                                <svg id="active_icon_5" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 5</span>
                        </label>
                    @endif
                    @if (6 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_6"
                                value="6">
                            <span class="level">
                                <svg id="active_icon_6" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 6</span>
                        </label>
                    @endif
                    @if (7 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_7"
                                value="7">
                            <span class="level">
                                <svg id="active_icon_7" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 7</span>
                        </label>
                    @endif
                    @if (8 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_8"
                                value="8">
                            <span class="level">
                                <svg id="active_icon_8" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 8</span>
                        </label>
                    @endif
                    @if (9 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_9"
                                value="9">
                            <span class="level">
                                <svg id="active_icon_9" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 9</span>
                        </label>
                    @endif
                    @if (10 <= $lastLevelActive->id)
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="nivel_10"
                                value="10">
                            <span class="level">
                                <svg id="active_icon_10" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Nivel 10</span>
                        </label>
                    @endif
                </div>
                <div class="tab-body-wrapper mt-2">
                    @include('unilevel.levels.level1')
                    @if (2 <= $lastLevelActive->id)
                        @include('unilevel.levels.level2')
                    @endif
                    @if (3 <= $lastLevelActive->id)
                        @include('unilevel.levels.level3')
                    @endif
                    @if (4 <= $lastLevelActive->id)
                        @include('unilevel.levels.level4')
                    @endif
                    @if (5 <= $lastLevelActive->id)
                        @include('unilevel.levels.level5')
                    @endif
                    @if (6 <= $lastLevelActive->id)
                        @include('unilevel.levels.level6')
                    @endif
                    @if (7 <= $lastLevelActive->id)
                        @include('unilevel.levels.level7')
                    @endif
                    @if (8 <= $lastLevelActive->id)
                        @include('unilevel.levels.level8')
                    @endif
                    @if (9 <= $lastLevelActive->id)
                        @include('unilevel.levels.level9')
                    @endif
                    @if (10 <= $lastLevelActive->id)
                        @include('unilevel.levels.level10')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection
@section('page-script')

    <script>
      function activeIcon(n) {
        $(`#active_icon_${n}`).removeClass('d-none')
        for (let index = 1; index == 10; index++) {
          if (index != n) {
            $(`#active_icon_${index}`).addClass('d-none')
          }
        }
      }
    </script>
    {{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
    <script>
        $('#nivel_1').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-1').removeClass('d-none');
        });
        $('#nivel_2').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-2').removeClass('d-none');
        });
        $('#nivel_3').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-3').removeClass('d-none');
        });
        $('#nivel_4').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-4').removeClass('d-none');
        });
        $('#nivel_5').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-5').removeClass('d-none');
        });
        $('#nivel_6').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-6').removeClass('d-none');
        });
        $('#nivel_7').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-7').removeClass('d-none');
        });
        $('#nivel_8').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-8').removeClass('d-none');
        });
        $('#nivel_9').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-9').removeClass('d-none');
        });
        $('#nivel_10').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-10').removeClass('d-none');
        });
        $('#nivel_11').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-11').removeClass('d-none');
        });
        $('#nivel_12').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-12').removeClass('d-none');
        });
        $('#nivel_13').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-13').removeClass('d-none');
        });
        $('#nivel_14').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-14').removeClass('d-none');
        });
        $('#nivel_15').click(() => {
            for (i = 1; i <= 15; i++) {
                $('#tab-body-' + i).addClass('d-none');
            }
            $('#tab-body-15').removeClass('d-none');
        });
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, 'desc']
            ],
            language: {
                lengthMenu: 'Mostrar _MENU_ registros',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando _PAGE_ de _PAGES_ entradas',
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
