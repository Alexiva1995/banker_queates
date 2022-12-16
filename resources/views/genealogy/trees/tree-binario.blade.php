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
                        <form action="{{ route('referred.tree', ['tree' => 1]) }}">
                            <label class="d-flex text-nowrap content-input">
                                <input type="radio" onclick="this.form.submit();">
                                    <span class="level">
                                    <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                        viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                            fill="white" />
                                    </svg>Unilevel</span>
                                </input>
                            </label>
                        </form>
                        <form action="{{ route('referred.tree', ['tree' => 2]) }}">
                            <label class="d-flex text-nowrap content-input">
                                <input type="radio" onclick="this.form.submit();" checked>
                                    <span class="level">
                                    <svg id="active_icon_2" class="me-50 mb-25" width="15" height="15"
                                        viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                            fill="white" />
                                    </svg>Binario</span>
                                </input>
                            </label>
                        </form>
                    </div>
                </div>

<div id="tree-body-2" class="tab-body">
    <ul>
        <li class="baseli p-0">

            {{-- usuario principal --}}
            <a href="#" class="base">
                <div class="media">
                    @if ($base->gender == null || $base->gender == '0')
                        <img src="{{ asset('images/avatars-profile/1.png') }}" height="64" width="64"
                        class="rounded-circle align-self-center mr-1 di" alt="{{ $base->name }}"
                        title="{{ $base->name }}">
                    @else
                        <img src="{{ asset('images/avatars-profile/2.png') }}" height="64" width="64"
                        class="rounded-circle align-self-center mr-1 di" alt="{{ $base->name }}"
                        title="{{ $base->name }}">
                    @endif
                    <div class="media-body">
                        <h5 class="mt-0"> <b>{{ $base->name }}</b></h5>
                    </div>
                </div>
            </a>
            {{-- Nivel 1 --}}
            <ul>
                @foreach ($trees as $child)
                    <li>
                        @include('genealogy.component.subniveles', ['data' => $child])
                        @if (!empty($child->children))
                            {{-- nivel 2 --}}
                            <ul>
                                @foreach ($child->children as $child1)
                                    {{-- genera el lado binario derecho haciendo vacio --}}
                                    <li>
                                        @include('genealogy.component.subniveles', [
                                            'data' => $child1,
                                        ])
                                        @if (!empty($child1->children))
                                            {{-- nivel 3 --}}
                                            <ul class="d-none d-sm-table-cell">
                                                @foreach ($child1->children as $child2)
                                                    {{-- genera el lado binario derecho haciendo vacio --}}
                                                    <li>
                                                        @include('genealogy.component.subniveles', [
                                                            'data' => $child2,
                                                        ])
                                                        @if (!empty($child2->children))
                                                            <ul>
                                                                @foreach ($child2->children as $child3)
                                                                    <li>
                                                                        @include('genealogy.component.subniveles',
                                                                            ['data' => $child3])
                                                                        @if (5 <= $lastLevelActive->id)
                                                                            @if (!empty($child3->children))

                                                                                <div id="moreLevel" class="d-none">
                                                                                    <ul>
                                                                                        @foreach ($child3->children as $child4)
                                                                                            <li>
                                                                                                @include('genealogy.component.subniveles',
                                                                                                    [
                                                                                                        'data' => $child4,
                                                                                                    ])
                                                                                                @if (6 <= $lastLevelActive->id)
                                                                                                    @if (!empty($child4->children))
                                                                                                        <ul>
                                                                                                            @foreach ($child4->children as $child5)
                                                                                                                <li>
                                                                                                                    @include('genealogy.component.subniveles',
                                                                                                                        [
                                                                                                                            'data' => $child5,
                                                                                                                        ])
                                                                                                                    @if (7 <= $lastLevelActive->id)
                                                                                                                        @if (!empty($child5->children))
                                                                                                                            <ul>
                                                                                                                                @foreach ($child5->children as $child6)
                                                                                                                                    <li>
                                                                                                                                        @include('genealogy.component.subniveles',
                                                                                                                                            [
                                                                                                                                                'data' => $child6,
                                                                                                                                            ])
                                                                                                                                        @if (8 <= $lastLevelActive->id)
                                                                                                                                            @if (!empty($child6->children))
                                                                                                                                                <ul>
                                                                                                                                                    @foreach ($child6->children as $child7)
                                                                                                                                                        <li>
                                                                                                                                                            @include('genealogy.component.subniveles',
                                                                                                                                                                [
                                                                                                                                                                    'data' => $child7,
                                                                                                                                                                ])
                                                                                                                                                            @if (9 <= $lastLevelActive->id)
                                                                                                                                                                @if (!empty($child4->children))
                                                                                                                                                                    <ul>
                                                                                                                                                                        @foreach ($child7->children as $child8)
                                                                                                                                                                            <li>
                                                                                                                                                                                @include('genealogy.component.subniveles',
                                                                                                                                                                                    [
                                                                                                                                                                                        'data' => $child8,
                                                                                                                                                                                    ])
                                                                                                                                                                                @if (10 <= $lastLevelActive->id)
                                                                                                                                                                                    @if (!empty($child4->children))
                                                                                                                                                                                        <ul>
                                                                                                                                                                                            @foreach ($child8->children as $child9)
                                                                                                                                                                                                <li>
                                                                                                                                                                                                    @include('genealogy.component.subniveles',
                                                                                                                                                                                                        [
                                                                                                                                                                                                            'data' => $child9,
                                                                                                                                                                                                        ])
                                                                                                                                                                                                </li>
                                                                                                                                                                                            @endforeach
                                                                                                                                                                                        </ul>
                                                                                                                                                                                    @endif
                                                                                                                                                                                @endif
                                                                                                                                                                            </li>
                                                                                                                                                                        @endforeach
                                                                                                                                                                    </ul>
                                                                                                                                                                @endif
                                                                                                                                                            @endif
                                                                                                                                                        </li>
                                                                                                                                                    @endforeach
                                                                                                                                                </ul>
                                                                                                                                            @endif
                                                                                                                                        @endif
                                                                                                                                    </li>
                                                                                                                                @endforeach
                                                                                                                            </ul>
                                                                                                                        @endif
                                                                                                                    @endif
                                                                                                                </li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    @endif
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            @endif
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                                                @endforeach
                                            </ul>
                                            {{-- fin nivel 3 --}}
                                        @endif
                                    </li>
                                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                                @endforeach
                            </ul>
                            {{-- fin nivel 2 --}}
                        @endif
                    </li>
                    {{-- genera el lado binario izquierdo haciendo vacio --}}
                @endforeach
            </ul>
            {{-- fin nivel 1 --}}
        </li>
    </ul>
</div>

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
