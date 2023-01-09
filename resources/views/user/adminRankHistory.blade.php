@extends('layouts/contentLayoutMaster')

@section('title', 'Usuarios')
@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">

@endsection
@section('content')
    <style>
        .ms-choice{
            margin: -3px;
            border: none !important;
        }
        .dt-buttons {
            width: 50%;
            display: inline;
        }

        .dt-button {
            border: none !important;
            border-radius: 5px !important;
            font-size: 1em !important;
            margin-bottom: -2rem;
        }

        .dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: #05A5E9 !important;
        }
    </style>
    <div class="d-flex my-1">
        <p class="fw-700 mb-0">Users</p>
    </div>
    <div class="col-12">
        <div class="card p-2">
            <div class="card-content">
                <div class="card-body p-0">
                    
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical myTable w-100">
                            <div class="card-content p-75">
                                <thead>
                                    <tr class="text-center ">
                                        <th class="fw-500">User ID</th>
                                        <th class="fw-500">Range ID</th>
                                        <th class="fw-500">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rangeHistoy as $log)
                                    <tr class="text-center">
                                        <td>{{ $log->user_id}}</td>
                                        <td>{{$rankName[$log->range]}}</td>
                                        <td>{{$log->created_at}}</td>
                                    </tr>
                                    @endforeach
                                       
                                </tbody>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
