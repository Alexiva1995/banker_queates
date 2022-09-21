@extends('layouts/contentLayoutMaster')

@section('title', 'Solicitudes de Retiros')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style type="text/css">

   .form-control {
        background: none !important;
        color: #000000 !important
    }
</style>
@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="d-flex my-1">
            <p class="fw-700 mb-0">Billetera</p><span class="fw-300 mx-1 text-light">|</span>
            <p class="fw-300 mb-0">Retiros</p>
        </div>
        <div class="card p-75">
            <div class="card-content">
                <div class="card-header">
                    <div class="d-flex justify-content-start"><h4 class="fw-700">Últimos retiros</h4></div>
                    <div class="d-flex justify-content-end">
                        <div class="d-flex col-12" style="margin-bottom:14px;">
                            <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end">Solicitar Retiro</a>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class=" text-center">
                                    <th class="fw-600">Fecha</th>
                                    <th class="fw-600 ">Estado</th>
                                    <th class="fw-600 ">Monto</th>
                                    <th class="fw-600 ">Fee</th>
                                    <th class="fw-600 ">Total</th>
                                    <th class="fw-600 ">Wallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retiros as $retiro)
                                <tr class=" text-center">
                                    <td >
                                        {{$retiro->updated_at}}
                                    </td>
                                    <td>
                                        

                                        @if($retiro->status == 0)
                                                <button class="btn bg-light-warning" style="color: #FE8900;">
                                                    En Espera
                                                </button>
                                            @elseif($retiro->status ==1)
                                                <button class="btn bg-light-success" style="color: #28C76F;">
                                                    Pagado
                                                </button>
                                            @else
                                                <button class="btn bg-light-danger" style="color: red;">
                                                    Retirado

                                                </button>
                                           
                                            @endif
                                    </td>
                                    <td class="text-end">
                                        {{number_format($retiro->amount_gross,2)}}
                                    </td>
                                    <td class="text-end">
                                        {{number_format($retiro->amount_fee,2)}}
                                    </td>
                                    <td class="text-end">
                                        {{number_format($retiro->amount_net,2)}}
                                    </td>
                                    <td>
                                        {{$retiro->wallet_used}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            "info":           "Mostrando _START_ de _END_ entradas",
            "infoFiltered":   "(filtrado de _MAX_ entradas)",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing":     "",
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron resultados",
            paginate: {
                first:    ' ',
                previous: ' ',
                next:     ' ',
                last:     ' '
            },
            aria: {
                paginate: {
                    first:    '',
                    previous: '',
                    next:     '',
                    last:     ''
                }
            }
        },
    })
</script>
@endsection
