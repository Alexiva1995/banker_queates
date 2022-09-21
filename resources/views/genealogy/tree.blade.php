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

    <div class="col-12">
        <div class="padre">
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
            <div class="d-flex justify-content-center d-none">
                <button id="show_levels"  onclick="moreLevel()" class="mt-1 btn btn-primary d-none d-sm-table-cell">Ver mas</button>
                <button id="hidden_levels"  onclick="hiddenLevel()" class="mt-1 btn btn-primary d-none ">Ver menos</button>
            </div>
        </div>
    </div>

    @if (Auth::id() != $base->id)
        @if (!Request::get('audit'))
            <div class="col-12 text-center">
                @if (Auth::user()->admin == 1)
                    <a class="btn btn-outline-primary border-primary rounded" href="{{ route('red.search') }}">Buscar otro
                        id</a>
                @else
                    <a class="btn btn-outline-primary border-primary rounded" href="{{ route('red.unilevel') }}">Regresar a
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
