@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
<style>
    div.dataTables_wrapper div.dataTables_paginate ul.pagination{
        justify-content: end!important;
    }
    .dt-button{
        background: transparent !important;
        border: none !important;
        border-radius: 5px !important;
        font-size: 1em !important;
        margin-bottom: -2rem;
    }
    .ms-choice{
        margin: -3px;
        border: none !important;
    }
</style>
@section('content')
<div id="logs-list">
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Reports</p><span class="fw-300 mx-1 text-light">|</span>
        <p class="fw-300 mb-0">Orders</p>
    </div>
    <div class="col-12 mt-2">
        <div class="card p-2">
            <div class="card-content p-50">
                <div class="card-header p-0">
                    <h4 class="fw-700">Orders</h4>
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Filters
                    </a>
                </div>
                <div class="card-body  p-0">
                    <div class="collapse" id="collapseExample">
                        <form action="{{ route('licenses.index.filter') }}" method="POST" class="mt-2">
                            @csrf
                            <div class="row">

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="user_id" class="form-label">ID User</label>
                                    <input type="number" class="form-control" id="user_id" name="user_id"
                                    @if($user_id) value="{{$user_id}}" @endif>
                                </div>

                                <div class="mb-2 col-md-4 col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                    @if($email) value="{{$email}}" @endif">
                                </div>

                                <div class="mb-2 col-md-4 col-sm-12">
                                    <label for="licenses_list" class="form-label">Licence</label>
                                    <select class="form-select multiple" name="licenses_list[]" id="licenses_list" multiple
                                        aria-label="Default select example">
                                        <option value="1" {{ in_array('1', $licenses_list) ? "selected" : null }}>
                                            Consultant Binary Position
                                        </option>
                                        <option value="2" {{ in_array('2', $licenses_list) ? "selected" : null }}>
                                            Standard License
                                        </option>
                                        <option value="3" {{ in_array('3', $licenses_list) ? "selected" : null }}>
                                            Gold License
                                        </option>
                                        <option value="4" {{ in_array('4', $licenses_list) ? "selected" : null }}>
                                            Titanium License
                                        </option>
                                        <option value="5" {{ in_array('5', $licenses_list) ? "selected" : null }}>
                                            Platinum License
                                        </option>
                                        <option value="6" {{ in_array('6', $licenses_list) ? "selected" : null }}>
                                            Banker Platinum License
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="date_from" class="form-label">From</label>
                                    <input type="date" class="form-control" id="date_from" name="date_from"
                                    @if($date_from) value="{{ $date_from }}"  @endif>
                                </div>

                                <div class="mb-2 col-md-6 col-sm-12">
                                    <label for="date_to" class="form-label">Until</label>
                                    <input type="date" class="form-control" id="date_to" name="date_to"
                                    @if($date_to) value="{{ $date_to }}"  @endif>
                                </div>
                               
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a class="btn btn-info" href="{{route('licenses.index')}}">Clear filtres</a>
                                    {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Licence</th>
                                    <th>Creation date</th>
                                    <th>Left days</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licenses as $item)
                                {{-- {{ dd($orden->coinpaymentTransaccion->txn_id) }} --}}
                                    <tr class="text-center">
                                        <td class="fw-300">{{$item->id}}</td>
                                        <td class="fw-300">{{$item->user->id}}</td>
                                        <td class="fw-300">{{$item->user->email}}</td>


                                        <td class="fw-300 text-end">{{$item->licensePackage->name}}</td>
                                        <td class="fw-300">{{$item->created_at->format('Y-m-d')}}</td>
                                        <td class="fw-300">{{ $item->updated_at->diffInDays($item->expiration_date) }}</p></td>
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
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>

@endsection
@section('page-script')
<script>
    $(".multiple").multipleSelect({
        filter: false
    });
    //datataables ordenes
    $('.myTable').DataTable({
        order: [
            [0, "desc"]
        ],
        pagingType: 'simple_numbers',
    });
</script>
@endsection
