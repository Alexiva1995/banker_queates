@extends('layouts/contentLayoutMaster')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('title', 'Paquetes')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        .nav-tabs .nav-link {
            position: relative;
            transition: transform 0.3s;
        }

        .nav-tabs .nav-link:hover {
            color: #0255b8 !important;
        }

        .contenedor {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        .entrada-blog a {
            display: inline-block;
            background-color: #2196F3;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
        }

        @media (min-width: 768px) {
            .dos-columnas {

                display: grid;
                /* tener acceso a muchas propiedades de css grid */
                grid-template-columns: 25% 25% 25% 25%;
                /* para tener una al lado de la otra */
                grid-template-columns: repeat(4, 25%);
                /* es lo mismo que el de arriba*/
                column-gap: 2rem;
                /*Separacion entre columnas */
            }

            div.card {
                height: 86%;
            }

            label.alert {
                border-radius: 18px;
                background-color: #28C76F;
                width: 19px;
                height: 19px;
                color: #ffffff;
                text-align: center !important;
            }

        }
    </style>
    <div class="row mt-3 mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fw-bold" style="margin-right:.5rem">Paquetes | </span>
                <li class="breadcrumb-item active">Paquetes</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <span>Por favor seleccione un mercado</span>
        <nav class="col-sm-12 lista">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Forex</button>
                <button class="nav-link" id="nav-indices-tab" data-bs-toggle="tab" data-bs-target="#nav-indices"
                    type="button" role="tab" aria-controls="nav-indices" aria-selected="false">Indices</button>
                <button class="nav-link" id="nav-crypto-tab" data-bs-toggle="tab" data-bs-target="#nav-crypto"
                    type="button" role="tab" aria-controls="nav-crypto" aria-selected="false">Crypto</button>
                <button  disabled class="nav-link" {{-- id="nav-auth-tab" data-bs-toggle="tab" data-bs-target="#nav-auth"
                type="button" role="tab" aria-controls="nav-auth" aria-selected="false" --}}>Binario
                    (Proximamente)</button>
            </div>
        </nav>
    </div>
    <div class="col-sm-12 col-sm-7 col-lg-12" style="margin-bottom: 30% ">
        {{-- apartado forex --}}
        <div class="row">
            <div class="col-lg-12 col-12">
                <div style="width: 90%; height: none">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="contenedor dos-columnas mt-2">
                                @foreach ($forexs as $forex)
                                    <div class="card">
                                        <div class="card-header mt-1">
                                            <p name="member" class="card-text fw-bolder mb-0">Membresía</p>
                                            @if ($forex->alert == 0)
                                                <div class="">
                                                    <i data-feather='bell'
                                                        style="height: 1.5rem !important; width: 1.5rem !important"></i>
                                                </div>
                                            @else
                                                <div class="">
                                                    <i data-feather='bell'
                                                        style="height: 1.5rem !important; width: 1.5rem !important"></i>
                                                    <label class="alert">{{ $forex->alert }}</label>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h2>{{ $forex->amount_per_month }} USD</h2>
                                            <form class="d-grid gap-2" action="{{ route('subadmin.package') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value={{$forex->membership_types_id}}>
                                                <input type="hidden" name="paquete" value={{ $forex->amount_per_month }}>
                                                <button class="btn text-white w-100" style="background: #0255B8;">Ver
                                                    Solucitudes</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @include('subadmin.ui.indices')
                        @include('subadmin.ui.crypto')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
