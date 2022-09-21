@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style type="text/css">
    div.volver {
        padding-left: 73%;
        margin-top: -1rem
    }

    @media (min-width: 768px) {
        div.volver {
            padding-left: 90%;
            margin-top: -2rem
        }

    }
</style>
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <span>Por favor seleccione un mercado</span>
                    <nav id='#nav_type'class="col-sm-12 lista">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                                type="button" role="tab" aria-controls="nav-home" aria-selected="true">Forex</button>
                            {{-- <button class="nav-link" id="nav-indices-tab" data-bs-toggle="tab" data-bs-target="#nav-indices"
                                type="button" role="tab" aria-controls="nav-indices" aria-selected="false">Indices</button> --}}
                            <button class="nav-link" id="nav-crypto-tab" data-bs-toggle="tab" data-bs-target="#nav-crypto"
                                type="button" role="tab" aria-controls="nav-crypto" aria-selected="false">Cryptos</button>
                            <button disabled class="nav-link" {{-- id="nav-auth-tab" data-bs-toggle="tab" data-bs-target="#nav-auth"
                            type="button" role="tab" aria-controls="nav-auth" aria-selected="false" --}}>Binario
                                (Proximamente)</button>
                        </div>
                    </nav>
                <div class="card p-2">
                    {{-- <h3>Más Vendidos</h3> --}}
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="row justify-content-init mt-1">
                                <div class="col-12 col-md-4 d-none">
                                    <label for="order_by_for">Por su tipo:</label>
                                    <select class="select2 form-control" name="type_package" id="type_package"
                                        data-toggle="select" class="form-control">
                                        <option id="forex_option" value="forex">Forex</option>
                                        {{-- <option value="sinteticos">Indices Sinteticos</option> --}}
                                        <option id="crypto_option" value="cryptos">Cryptos</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="order_by_for">Organizar Por:</label>
                                    <select class="select2 form-control" name="order_by_for" id="order_by_for"
                                        data-toggle="select" class="form-control">
                                        
                                        <option id="for_install" value="Por Instalar">Por instalar</option>
                                        <option value="Instalado">Instalados</option>
                                        <option value="Rechazado">Rechazados</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table rounded border-table" id="formularyTable"></table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

@endsection
@section('page-script')



    <script>
        $(document).ready(function() {
            table = $('#formularyTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                pageLength: 10,
                language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                ajax: {
                    url: '/datatable/package',
                    method: 'GET',
                    data: function(d) {
                        d.category_id = $('#type_package').val();
                        d.order_by_for = $('#order_by_for').val();
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                columns: [{
                        data: "username",
                        name: "username",
                        title: "Nombre",
                        "class": "text-center",
                        visible: true,
                        searchable: true,
                    },
                    {
                        data: "useremail",
                        name: "useremail",
                        title: "Email",
                        "class": "text-center",
                        visible: true,
                        searchable: true,
                    },
                    {
                        data: "package",
                        name: "package",
                        title: "Paquete",
                        "class": " text-center",
                        visible: true,
                        searchable: true,
                    },
                    {
                        data: "type",
                        name: "type",
                        title: "Tipo",
                        "class": "text-center type_select",
                        visible: true,
                        searchable: true,
                    },
                    {
                        data: "date",
                        name: "date",
                        title: "Fecha de creación",
                        "class": "text-center",
                        visible: true,
                        searchable: true,
                    },
                    {
                        data: "status",
                        name: "status",
                        title: "Estado",
                        "class": "text-center status_select",
                        visible: true,
                        searchable: true,
                        render: function (data, type, row, meta) {
                            switch (row.status) {
                                case 'Por Instalar':
                                    return '<span class="badge badge-light-warning">Por Instalar</span>';
                                    break;
                                case 'Instalado':
                                    return '<span class="badge badge-light-success">Instalado</span>';
                                    break;
                                case 'Rechazado':
                                    return '<span class="badge badge-light-danger">Rechazado</span>';
                                    break;
                                default:
                                    break;
                                }
                            }
                        },
                        {
                        data: "[]",
                        name: "status",
                        title: "Accion",
                        "class": " text-center",
                        visible: true,
                        searchable: false,
                    },
                ],
                fnCreatedRow: function(elemt, data, iDataIndex) {
                    var indice = iDataIndex + 1;
                    
                    let idFormulary = +data.id;
                    let url = '{{route('subadmin.details', ['temp '])}}';
                    url = url.replace('temp', idFormulary);

                    field = $('td:eq(6)', elemt);
                    buttons = '';
                    button = `<a href="${url}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                        </svg>
                        </a>`
                    buttons += button;
                    field = field.html(buttons);
                },
            });



            // .on('processing.dt', function (e, settings, processing) {
            //     feather.replace();
            // });
            table.columns('.type_select').every(function() {
                var that = this;
                
                // Create the select list and search operation
                var select = $('#type_package')
                .on('change', function() {

                    that
                    .search($(this).val())
                    .draw();
                    
                });
                
                // Get the search data for the first column and add to the select list
                this
                .cache('search')
                .sort()
                .unique()
            });
            
            table.columns('.status_select').every(function() {
                var that = this;
                // Create the select list and search operation
                var select = $('#order_by_for')
                .on('change', function() {

                        that
                        .search($(this).val())
                        .draw();
                    });
                    
                    // Get the search data for the first column and add to the select list
                    this
                    .cache('search')
                    .sort()
                    .unique()  
                    
                });
                
                // $('#type_package').change(function() {


                    //     table.search('').draw();
            // });
            
            // $('#order_by_for').change(function() {
            //     table.search('').draw()
            // });
            $('#formularyTable').ready(function () {
                const forex = document.getElementById('type_package')
                const forInstall = document.getElementById('order_by_for')
                forex.value = 'forex'
                forInstall.value = 'Por Instalar'
                $('#for_install').trigger("change")
                $('#forex_option').trigger("change")
            })
            $('#nav-home-tab').click(function () {
                const forex = document.getElementById('type_package')
                forex.value = 'forex'
                $('#forex_option').trigger("change")
            })
            $('#nav-crypto-tab').click(function () {
                const crypto = document.getElementById('type_package')
                crypto.value = 'cryptos'
                $('#crypto_option').trigger("change")
            })
        });
        </script>
@endsection
