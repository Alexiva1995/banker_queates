@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de Retiros')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
.fw-700{
    font-weight: 700!important;
}
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Retiro</p><span class="fw-normal mx-1">|</span><p>Retiros</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-header mb-1 p-0 justify-content-end">
                    <h5 class="fw-700 me-auto mb-sm-1">Últimos retiros</h5>
                    <a type="buttom" class="btn btn-primary pt-1" href="{{route('solicitudesRetiros')}}">Solicitar retiro</a>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-end">
                                    <th>Fecha aa</th>
                                    <th>Estado</th>
                                    <th>Monto Bruto</th>
                                    <th>Feed</th>
                                    <th>Monto Total</th>
                                    <th>wallet</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawals as $withdrawal)
                                    <tr class="text-end">
                                        <td>
                                            {{$withdrawal->created_at->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            @if($withdrawal->status == 0)
                                                <button class="btn bg-light-warning" style="color: #FE8900;">
                                                    En Espera por procesar
                                                </button>
                                            @elseif($withdrawal->status ==1)
                                                <button class="btn bg-light-success" style="color: #28C76F;">
                                                    Aprobada
                                                </button>
                                            @elseif($withdrawal->status ==2)
                                                <button class="btn bg-light-danger" style="color: red;">
                                                    Cancelada
                                                </button>
                                            @else
                                                <button class="btn bg-light-info">
                                                    Por Pagar
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <p>{{$withdrawal->amount_gross}}</p>
                                        </td>
                                        <td>
                                            <p>{{$withdrawal->amount_fee}}</p>
                                        </td>
                                        <td>
                                            <p>{{$withdrawal->amount_net}}</p>
                                        </td>
                                        <td>
                                            {{$withdrawal->decryptWallet() }}
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
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "next": " ",
                "previous": " "
            }
        },
        pagingType: 'simple_numbers',
    })
    const table = $('.myTable').DataTable()
    if ( ! table.data().any() ) {
        $('.myTable').find('.odd').replaceWith('')
        $("tbody").append('<tr><td colspan="8" class="dataTables_empty"><i data-feather="align-left" style="width: 3rem !important;  height: 2rem !important;"></i></td><tr><td colspan="8" class="dataTables_empty"><span style="font-size: 12px;">Sin registros realizados<span></td></tr><tr><td colspan="8" class="dataTables_empty"></i><a class="btn btn-sm btn-primary" id="enviar" type="button"  href="{{route('solicitudesRetiros')}}">Solicitar Retiro</a></td></tr>');
    }
</script>

@endsection
