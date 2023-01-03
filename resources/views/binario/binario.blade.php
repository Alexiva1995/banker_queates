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
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
    <style>
        .center-binary{
            margin: auto !important;
        }
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
        .content-input {
            position: relative;
            display: block;
            cursor: pointer;
            width: 100px;
        }

        /* Estas reglas se aplicarán a todos los span despues de un input de tipo radio*/
        .content-input input[type=radio]+span {}

        .content-input input[type=radio]+span:before {
            background-color: #05A5E9;
            color: #fff;
        }

        .content-input input[type=radio]:checked+span {
            background-color: #05A5E9 !important;
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

        .rounded-circle {
            width: auto;
            height: auto;
            max-width: 128%;
        }
        
        .form-control{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
        }
        .rounded-circle-add {
            width: auto;
            height: auto;
            max-width: 100%;
        }
    </style>

    <div class="col-12">
        <div class="padre">

            <div class="d-flex my-1">
                <p class="fw-700 mb-0">Network</p><span class="fw-300 text-primary mx-1 ">|</span>
                <p class="fw-400 mb-0">Binario</p>
            </div>
            <div class="card">
                <div class="card-content p-75">
                    <div class="card-header d-block p-2 pb-0">
                        <div class="d-flex justify-content-between align-item-center flex-wrap  gap-50">
                            <h4 class="fw-700">Binary</h4>
                            
                        </div>
                    </div>
                    <div class="card-content p-75">
                        <div class="card-header d-block p-3 pb-0">
                            <form action="{{ route('search.binary') }}" method="POST">
                                @csrf
                                <div class="row justify-content-end">
                                    <div class="col-md-2 col-sm-4">
                                        <div class=" white mt-1">
                                            <input type="number" placeholder="Id User" name="id"
                                                class="form-control" id="id">
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-sm-3">
                                        <div class=" white mt-1">
                                            <button type="submit" class="btn btn-primary ">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="tree-body-2" class="tab-body">
                        <ul>
                            <li class="baseli p-0" style="overflow:scroll">

                                {{-- usuario principal --}}
                                    <div style="width:1000px; margin: 0 auto">
                                        @if ($base['range_id'] != null)
                                            <img src="{{ asset('images/ensignRanges/' . $base['range_id'] . '.png') }}"
                                                height="100" width="120" class="align-self-center mr-1 di"
                                                alt="{{ $base['range_id'] }}">
                                        @elseif($base['range_id'] == null && !empty($base->licence))
                                            <img src="{{ asset('images/ensignRanges/' . $base->investment->package_id . '.png') }}"
                                                height="100" width="120" class="align-self-center mr-1 di"
                                                alt="{{ $base['range_id'] }}">
                                        @elseif ($base['range_id'] == null && empty($base->licence))
                                            <img src="{{ asset('images/ensignRanges/0.png') }}" height="110"
                                                width="110" class="mt-1" style="margin-top: -4px"
                                                alt="{{ $base->name }}" title="{{ $base->name }}">
                                        @endif
                                        <div class="media-body">
                                            <h5 class="mt-0"> <b>{{ $base->name }}</b></h5>

                                            {{-- esto se debe quitar cuando ya esten las imagenes, solo es de prueba para saber que llegan los datos --}}
                                            <!--<h5 class="mt-0"> <b>Licencia: </b></h5>-->
                                            <!--<h5 class="mt-0"> <b>Rango: </b></h5>-->
                                        </div>
                                    </div>

            
                                {{-- Nivel 1 --}}
                                <ul style="width: 1000px; margin: 0 auto;">
                                    @foreach ($trees as $child)
                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                        @if ($child->binary_side == 'R')
                                            @include('genealogy.component.sideEmpty', [
                                                'side' => 'R',
                                                'cant' => count($trees),
                                                'ladouser' => $child->binary_side,
                                            ])
                                        @endif
                                        <li>
                                            @include('genealogy.component.subnivelesBinario', [
                                                'data' => $child,
                                            ])
                                            @if (!empty($child->children))
                                                {{-- nivel 2 --}}
                                                <ul>
                                                    @foreach ($child->children as $child1)
                                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                                        @if ($child1->binary_side == 'R')
                                                            @include('genealogy.component.sideEmpty', [
                                                                'side' => 'R',
                                                                'cant' => count($child->children),
                                                                'ladouser' => $child1->binary_side,
                                                            ])
                                                        @endif
                                                        <li>
                                                            @include('genealogy.component.subnivelesBinario',
                                                                [
                                                                    'data' => $child1,
                                                                ])
                                                            @if (!empty($child1->children))
                                                                {{-- nivel 3 --}}
                                                                <ul>
                                                                    @foreach ($child1->children as $child2)
                                                                        {{-- genera el lado binario derecho haciendo vacio --}}
                                                                        @if ($child2->binary_side == 'R')
                                                                            @include('genealogy.component.sideEmpty',
                                                                                [
                                                                                    'side' => 'R',
                                                                                    'cant' => count(
                                                                                        $child1->children
                                                                                    ),
                                                                                    'ladouser' =>
                                                                                        $child2->binary_side,
                                                                                ])
                                                                        @endif
                                                                        <li>
                                                                            @include('genealogy.component.subnivelesBinario',
                                                                                [
                                                                                    'data' => $child2,
                                                                                ])
                                                                        </li>
                                                                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                                                                        @if ($child2->binary_side == 'L')
                                                                            @include('genealogy.component.sideEmpty',
                                                                                [
                                                                                    'side' => 'L',
                                                                                    'cant' => count(
                                                                                        $child1->children
                                                                                    ),
                                                                                    'ladouser' =>
                                                                                        $child2->binary_side,
                                                                                ])
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                                {{-- fin nivel 3 --}}
                                                            @endif
                                                        </li>
                                                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                                                        @if ($child1->binary_side == 'L')
                                                            @include('genealogy.component.sideEmpty', [
                                                                'side' => 'L',
                                                                'cant' => count($child->children),
                                                                'ladouser' => $child1->binary_side,
                                                            ])
                                                        @endif
                                                    @endforeach
                                                </ul>
                                                {{-- fin nivel 2 --}}
                                            @endif
                                        </li>
                                        {{-- genera el lado binario izquierdo haciendo vacio --}}
                                        @if ($child->binary_side == 'L')
                                            @include('genealogy.component.sideEmpty', [
                                                'side' => 'L',
                                                'cant' => count($trees),
                                                'ladouser' => $child->binary_side,
                                            ])
                                        @endif
                                    @endforeach
                                </ul>
                                {{-- fin nivel 1 --}}
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-center d-none">
                        <button id="show_levels" onclick="moreLevel()"
                            class="mt-1 btn btn-primary d-none d-sm-table-cell">Ver
                            mas</button>
                        <button id="hidden_levels" onclick="hiddenLevel()" class="mt-1 btn btn-primary d-none ">Ver
                            menos</button>
                    </div>
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
        <script src="assets/js/scripts.bundle.js"></script>

    @endsection

    @section('page-script')

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
