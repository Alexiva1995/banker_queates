@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
    .fw-700 {
        font-weight: 700 !important;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        justify-content: end !important;
    }
</style>
@section('content')
    <div id="logs-list">
        <div class="d-flex my-2">
            <p style="color:#808E9E;" class="fw-700">Inversiones</p>
        </div>
        <div class="col-12">
            <div class="card p-2">
                <div class="card-content">
                    <div class="card-header my-1 p-0">
                        <h4 class="fw-700">Inversiones</h4>
                    </div>
                    <div class="card-body card-dashboard p-2 row">
                        @foreach ($investments as $inversion)
                            <div class="card col-md-4 col-lg-3 col-sm-4">
                                <div class="d-flex justify-content-center">
                                    @if ($inversion->licensePackage->image === null)
                                        <div class="card rounded-0 mb-0 border-0" style="width: 80%;">
                                            <div style="height: 161px; width:161px"
                                                class="text-center d-flex align-items-center justify-content-center title-mobile">
                                                <img src="{{ asset('images/licencias/' . $inversion->licensePackage->image) }}"
                                                    alt="{{ $inversion->licensePackage->image }}"
                                                    class="d-block rounded mx-auto" />
                                            </div>
                                            {{-- <img src="{{ asset('images/MembershipsPackage/Bronce/' . $inversion->licensePackage->image) }}"
                                            alt="{{ $inversion->licensePackage->image }}" height="161" width="161"
                                            class="d-block rounded mx-auto" /> --}}
                                            {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                        </div>
                                    @else
                                        <div class="card rounded-0 mb-0 border-0" style="width: 80%;">

                                            <img src="{{ asset('images/licencias/' . $inversion->licensePackage->image) }}"
                                                alt="{{ $inversion->licensePackage->image }}"
                                                class="d-block rounded mx-auto" style="width: 115px;margin-top: 6%;" />
                                            {{-- <h2 class="fw-600 font-large-1 text-switch position-absolute mb-0 top-50 start-50 translate-middle">${{ number_format($package->amount, 0,',' , '.') }}</h2> --}}

                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="card-body px-sm-2">
                                    <p>Estado</p>
                                    <h2 class="fw-600 mb-75 text-center">

                                        @if ($inversion->status == 0)
                                            <p class="text-warning fw-bold">En espera</p>
                                        @elseif($inversion->status == 1)
                                            <p class="text-success fw-bold">Activo</p>
                                        @else
                                            <p class="text-danger fw-bold">Inactivo</p>
                                        @endif
                                    </h2><br>
                                    <p>Dias restantes: </p>
                                    <h2 class="fw-600 mb-75 text-center">
                                        <p class="text-warning fw-bold">
                                            {{ now()->diffInDays($inversion->expiration_date) }}</p>
                                    </h2><br>
                                    <p>Fecha Activación: {{ $inversion->updated_at->format('Y-m-d') }}</p>
                                    <p>Fecha Vencimiento: {{ $inversion->expiration_date }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

@endsection
@section('page-script')
    <script>
        //datataables ordenes
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, "desc"]
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
@endsection
