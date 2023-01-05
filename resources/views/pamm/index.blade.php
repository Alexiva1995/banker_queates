@extends('layouts/contentLayoutMaster')

@section('title', 'Comision')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

@endsection
<style>
    .fw-700 {
        font-weight: 700 !important;
    }
    .ms-choice{
        border: none !important;
        margin: -3px;
    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        justify-content: end !important;
    }

    .dt-button {
        background: transparent !important;
        border: none !important;
        border-radius: 5px !important;
        font-size: 1em !important;
        margin-bottom: -2rem;
    }
    .success-badge{
        background-color: rgba(66, 172, 70, 0.16);
    }
    .success-text{
        color: #42AC46;
    }
    .waiting-text{
        color: #36D9ED;
    }
    .waiting-badge{
        background-color: #D6F7FB;
    }
    .warning-text{
        color: #FF4969;
    }
    .warning-badge{
        background-color: #FBE3E4;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-1">
        <p class="fw-700 mb-0" style="font-weight: 700; color:#000">Reports</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">Commissions</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Commissions</h4>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th class="fw-600">ID</th>
                                    <th class="fw-600">User</th>
                                    <th class="fw-600">ID User</th>
                                    <th class="fw-600">Amount</th>
                                    <th class="fw-600">Status</th>
                                    <th class="fw-600">Type</th>
                                    <th class="fw-600">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wallets as $key => $wallet)
                                <tr>
                                    <td class="fw-600 text-center">{{$wallet->id}}</td>
                                    <td class="fw-300 text-center">{{$wallet->buyer->name ?? '--'}}</td>
                                    <td class="fw-300 text-center">{{$wallet->buyer->id ?? '--'}}</td>
                                    <td class="fw-300 text-end">{{number_format($wallet->amount,2)}}</td>
                                    <td class="fw-300 text-center">
                                    @if ($wallet->status == 0)
                                        <span class="badge success-badge">
                                            <span class="success-text">Available</span>
                                        </span>
                                    @elseif($wallet->status == 1)
                                        <span class="badge waiting-badge">
                                            <span class="waiting-text">Requested</span>
                                        </span>
                                    @elseif($wallet->status == 2)
                                        <span class="badge success-badge">
                                            <span class="success-text">Paid</span>
                                        </span>
                                    @elseif($wallet->status == 3)
                                        <span class="badge warning-badge">
                                            <span class="warning-text">Canceled</span>
                                        </span>
                                    @elseif($wallet->status == 4)
                                        <span class="badge warning-badge">
                                            <span class="text-warning">Substracted</span>
                                        </span>
                                    @endif
                                    </td>
                                    <td class="fw-300 text-center">
                                        @switch($wallet->type)
                                        @case( 0 )
                                        MLM PAMM
                                        @break
                                        @case( 1 )
                                        Binary
                                        @break
                                        @default
                                        @case( 2 )
                                        Assigned
                                        @break
                                        @endswitch
                                    </td>

                                    <td class="fw-300 text-center">{{date('Y-m-d', strtotime($wallet->created_at))}}
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection


{{-- CONFIGURACIÓN DE DATATABLE --}}
@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<!-- Include plugin -->
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>


@endsection
@section('page-script')
<script>
     // Initialize multiple select on your regular select
    //datataables ordenes
    $( document ).ready(function() {
        $('#exampleModalCenter').modal('show')
    });
    $('.myTable').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
        pagingType: 'simple_numbers',
        
    })

    // const btn_clear = document.querySelector('#btn_clear');
    // // Clear filter inputs
    // btn_clear.addEventListener('click', ()=>{
    //     document.querySelector('#user_id').value = '';
    //     document.querySelector('#user_name').value = '';
    //     document.querySelector('#buyer_id').value = '';
    //     document.querySelector('#buyer_name').value = '';
    //     document.querySelector('#date_from').value = '';
    //     document.querySelector('#date_to').value = '';
    //     document.querySelector('#comission_status').value = '';
    //     document.querySelector('#comission_type').value = '';
    // });
</script>
@endsection