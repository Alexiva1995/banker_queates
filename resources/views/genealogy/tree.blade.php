@extends('layouts/contentLayoutMaster')

@section('title', 'Lista referidos')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/tree-matriz.css') }}" />
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

        .content-input {
            position: relative;
            display: block;
            cursor: pointer;
            width: 100px;
        }

        /* Estas reglas se aplicarán a todos los span despues de un input de tipo radio*/
        .content-input input[type=radio]+span {}

        .content-input input[type=radio]+span:before {
            background-color: #673DED;
            color: #fff;
        }

        .content-input input[type=radio]:checked+span {
            background-color: #673DED !important;
            color: #fff;
            border-radius: 5px;
            opacity: 1;
        }

        /* .content-input:hover input[type=radio]:not(:checked)+span {
            background: #673DED;
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
            background-color: #673DED;
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

    <div class="col-12">
        <div class="padre">

            <div class="d-flex my-1">
                <p class="fw-700 mb-0">Red</p><span class="fw-300 mx-1 text-light">|</span>
                <p class="fw-400 mb-0">Arbol de referidos</p>
            </div>
            <div class="card">
                <div class="card-content p-75">
                    <div class="card-header d-block p-2 pb-0">
                        <div class="d-flex justify-content-between align-item-center flex-wrap  gap-50">
                            <h4 class="fw-700">Tipo de arbol</h4>
                        </div>
                    </div>
                </div>
                <div class="tabs-wrapper px-2 mb-2">
                    <div class="d-flex level-content flex-wrap mt-1">
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="arbol-1" value="1"
                                checked>
                            <span class="level">
                                <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Unilevel</span>
                            </input>
                        </label>
                        <label class="d-flex text-nowrap content-input">
                            <input onclick="activeIcon()" type="radio" name="nivel" id="arbol-2" value="2">
                            <span class="level">
                                <svg id="active_icon_2" class="me-50 mb-25" width="15" height="15"
                                    viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                        fill="white" />
                                </svg>Binario</span>
                            </input>
                        </label>
                    </div>
                </div>

                @include('genealogy.trees.tree-unilevel')

                @include('genealogy.trees.tree-binario')


                <div class="d-flex justify-content-center d-none">
                    <button id="show_levels" onclick="moreLevel()" class="mt-1 btn btn-primary d-none d-sm-table-cell">Ver
                        mas</button>
                    <button id="hidden_levels" onclick="hiddenLevel()" class="mt-1 btn btn-primary d-none ">Ver
                        menos</button>
                </div>
            </div>
        </div>

        @if (Auth::id() != $base->id)
            @if (!Request::get('audit'))
                <div class="col-12 text-center">
                    @if (Auth::user()->admin == 1)
                        <a class="btn btn-outline-primary border-primary rounded" href="{{ route('red.search') }}">Buscar
                            otro
                            id</a>
                    @else
                        <a class="btn btn-outline-primary border-primary rounded"
                            href="{{ route('red.unilevel') }}">Regresar a
                            mi arbol</a>
                    @endif
                </div>
            @endif
        @endif


    @endsection

    @section('vendor-script')
        <!-- vendor files -->
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    @endsection

    @section('page-script')
        
        <script>
            $('#arbol-1').click(() => {
                $('#tree-body-2').addClass('d-none');
                $('#tree-body-1').removeClass('d-none');
            });
            $('#arbol-2').click(() => {
                $('#tree-body-1').addClass('d-none');
                $('#tree-body-2').removeClass('d-none');
            });
        </script>
        <script>
            function moreLevel() {
                $('#moreLevel').removeClass('d-none')
                $('#show_levels').addClass('d-none')
                $('#hidden_levels').removeClass('d-none')
            }

            function hiddenLevel() {
                $('#moreLevel').addClass('d-none')
                $('#show_levels').removeClass('d-none')
                $('#hidden_levels').addClass('d-none')
            }
        </script>
        <script type="text/javascript">
            function tarjeta(data, url, img) {

                $('#nombre').text(data.fullname);
                /*
                if (data.photoDB == null) {
                    $('#imagen').attr('src', img);
                } else {
                    $('#imagen').attr('src', '/storage/photo/' + data.photoDB);
                }
                */
                var date_db = new Date(data.created_at);
                var year = date_db.getFullYear();
                var month = (1 + date_db.getMonth()).toString();
                month = month.length > 1 ? month : '0' + month;
                var day = date_db.getDate().toString();
                day = day.length > 1 ? day : '0' + day;
                var date = month + '/' + day + '/' + year;
                $('#fecha_ingreso').text(date);

                $('#email').text(data.email);

                if (data.status == 0) {
                    $('#estado').html('<span class="badge bg-warning text-dark">Inactivo</span>');
                } else if (data.status == 1) {
                    $('#estado').html('<span class="badge bg-success"">Activo</span>');
                } else if (data.status == 2) {
                    $('#estado').html('<span class="badge bg-danger">Eliminado</span>');
                }

                // if(data.inversion != ' '){
                //     $('#inversion').text(data.inversion);
                // }else{
                //     $('#inversion').text('Sin inversion');
                // }

                $('#ver_arbol').attr('href', url);
                $('#ver_arbol').removeClass('d-none');
                $('#tarjeta').removeClass('d-none');
            }
        </script>
    @endsection
