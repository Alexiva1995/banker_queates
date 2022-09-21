@extends('layouts/contentLayoutMaster')

@section('title', 'Niveles')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    {{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection
<style>
    .fw-700 {
        font-weight: 700 !important;
    }
</style>
@section('content')
    <!-- Statistics card section -->
    <div class="d-flex my-2">
        <p class="fw-700">Activacion de niveles</p>
    </div>
    <section class="row"> 
        <div class="d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card" style="width: 35rem;">
                    <div class="card-body">
                        <div class="d-flex justify-content-center my-1">
                            <img src="{{ asset('images/logo/projecas.png') }}" width="150" alt="">
                        </div>
                        <p class="text-center">Nivel maximo activado actualmente: {{ $lastLevelActive->name }}</p>
                        <p class="text-center">Por favor ingrese hasta que nivel activar o desactivar</p>
                        <div class="d-flex justify-content-end">
                            <form id="active-level" class="d-flex justify-content-center custom px-1" action="{{ route('activate_levels') }}"
                                method="POST">
                                @csrf
                                <div class=" input-group mb-1">
                                    <select class=" form-select" aria-label="Default select example" name="level">
                                        <option selected disabled>Seleccione hasta que nivel a activar</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-2 justify-content-center">
                                    <button class="btn btn-primary" type="submit">Activar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


