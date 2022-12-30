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
        <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">Manual Bonus History</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Manual Bonus History</h4>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Filters
                    </a>
                </div>
                <div class="card-body card-dashboard p-0">
                    <div class="collapse" id="collapseExample">
                        <form action="" method="POST" class="mt-2">
                            @csrf
                            <div class="row">
                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="user_name" class="form-label">User</label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" 
                                    @if($user_name != null) value="{{$user_name}}" @endif">
                                </div>

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="author_name" class="form-label">Author</label>
                                    <input type="text" class="form-control" id="author_name" name="author_name"
                                    @if($author_name != null) value="{{$author_name}}" @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="actions" class="form-label">Action</label>
                                    <select class="form-select multiple" name="actions[]" id="actions" multiple
                                        aria-label="Default select example">
                                        <option value="suma" {{ in_array('suma', $actions) ? "selected" : null }} >Suma</option>
                                        <option value="resta" {{ in_array('resta', $actions) ? "selected" : null }} >Resta</option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="date_from" class="form-label">From</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from"
                                    @if($date_from != null) value="{{ $date_from }}"  @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="date_to" class="form-label">Until</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to"
                                    @if($date_to != null) value="{{ $date_to }}"  @endif>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a class="btn btn-info" href="{{route('manual.bonus.history')}}">Clear filters</a>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th class="fw-600">ID</th>
                                    <th class="fw-600">Action</th>
                                    <th class="fw-600">User</th>
                                    <th class="fw-600">Author</th>
                                    <th class="fw-600">Amount</th>
                                    <th class="fw-600">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $key => $item)
                                <tr class="text-center">
                                    <td class="fw-300 text-center">{{ $item->id }}</td>
                                    <td>
                                        @if ($item->action == 'suma de saldo')
                                            <span class="badge success-badge">
                                                <span class="success-text">Sum of Balance</span>
                                            </span>
                                        @else
                                            <span class="badge warning-badge">
                                                <span class="warning-text">Subtraction of Balance</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->user->name }}</td>
                                    <td class="fw-300 text-center">{{ $item->author->name }}</td>
                                    <td class="fw-300 text-end">{{ number_format($item->amount,2) }}</td>
                                    <td class="fw-300 text-center">{{ $item->updated_at->format('Y-m-d')}}</td>
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
    $(".multiple").multipleSelect({
        filter: false
    });

    //datataables ordenes
    $('.myTable').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
        pagingType: 'simple_numbers',
    })

</script>
@endsection