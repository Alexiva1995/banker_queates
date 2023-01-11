@extends('layouts/contentLayoutMaster')

@section('title', 'File LPOA')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
@endsection
<style>
    div.dataTables_wrapper div.dataTables_paginate ul.pagination {
        justify-content: end !important;
    }

    .ms-choice {
        margin: -3px;
        border: none !important;
    }

    .dt-button {
        background: transparent !important;
        border: none !important;
        border-radius: 5px !important;
        font-size: 1em !important;
        margin-bottom: -2rem;
    }

    .success-badge {
        background-color: rgba(66, 172, 70, 0.16);
    }

    .success-text {
        color: #42AC46;
    }

    .waiting-text {
        color: #36D9ED;
    }

    .waiting-badge {
        background-color: #D6F7FB;
    }

    .warning-text {
        color: #FF4969;
    }

    .warning-badge {
        background-color: #FBE3E4;
    }
</style>
@section('content')
    <div id="logs-list">
        <div class="d-flex my-1">
            <p class="fw-700 mb-0" style="font-weight: 700; color:#000">PAMM</p><span class="fw-300 mx-1 text-light">|</span>
            <p class="fw-700 mb-0" style="font-weight: 700; color:rgba(0, 0, 0, 0.514)">PAMM</p>
        </div>
        <div class="col-12 mt-2">
            <div class="card p-2">
                <div class="card-content p-50">
                    <div class="card-header p-0">
                        <h4 class="fw-700">PAMM</h4>
                    </div>
                    <div class="card-body  p-0">
                        <div class="table-responsive">
                            <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                                <thead class="">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Account ID</th>
                                        <th>Customer ID</th>
                                        <th>Status</th>
                                        <th>LPOA File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWhizfx as $key => $whizfx)
                                        <tr class="text-center">
                                            <td class="fw-600">{{ $whizfx->id }}</td>
                                            <td class="fw-300">{{ $whizfx->user->id }}</td>
                                            <td class="fw-300">{{ $whizfx->account_id }}</td>
                                            <td class="fw-300">{{ $whizfx->customer_id }}</td>
                                            @if (Auth::user()->admin == 1)
                                                <td class="fw-300">
                                                    <button type="button"
                                                        @if (Auth::user()->admin == '1' && $whizfx->status == '0') data-bs-toggle="modal"
                                                    data-bs-target="#ModalStatus{{ $whizfx->id }}" @endif
                                                        class="@if ($whizfx->status == '0') btn btn-warning text-white text-bold-600 @elseif($whizfx->status == '1') btn btn-info text-white text-bold-600 @elseif($whizfx->status == '2') btn btn-danger text-white text-bold-600 @endif">
                                                        @if ($whizfx->status == '0')
                                                            Pending
                                                        @elseif ($whizfx->status == '1')
                                                            Approved
                                                        @else
                                                            Refused
                                                        @endif
                                                    </button>
                                                </td>
                                                <div class="modal fade" id="ModalStatus{{ $whizfx->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Change status
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('whizfx.cambiarStatus') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <input type="hidden" name="id"
                                                                        value="{{ $whizfx->id }}">
                                                                    Do you want to change the status of the whizfx account?
                                                                    <br>
                                                                    <label>Select state</label>
                                                                    <select name="status" required class="form-control">
                                                                        <option value="">Select a state</option>
                                                                        <option value="1">Approved</option>
                                                                        <option value="2">Rejected</option>
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <td class="fw-300">
                                                <form class="mt-1" action="{{route('download.lpoa.admin')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{$whizfx->lpoa_file}}" name="name">
                                                    <button type="submit" class="btn btn-primary">Download File</button>
                                                </form>
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
        $("#order_status").multipleSelect({
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
