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

    .ms-choice {
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
            <p class="fw-700 mb-0" style="font-weight: 700; color:#000">Reports</p><span
                class="fw-300 mx-1 text-light">|</span>
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
                                    @if (Auth::user()->whizfxs != null)
                                    @if (Auth::user()->whizfx->status != '0')
                                    @foreach ($wallets as $key => $wallet)
                                        <tr>
                                            <td class="fw-600 text-center">{{ $wallet->id }}</td>
                                            <td class="fw-300 text-center">{{ $wallet->buyer->name ?? '--' }}</td>
                                            <td class="fw-300 text-center">{{ $wallet->buyer->id ?? '--' }}</td>
                                            <td class="fw-300 text-end">{{ number_format($wallet->amount, 2) }}</td>
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
                                                    @case(0)
                                                        MLM PAMM
                                                    @break

                                                    @case(1)
                                                        Binary
                                                    @break

                                                    @default
                                                        @case(2)
                                                            Assigned
                                                        @break
                                                    @endswitch
                                                </td>

                                                <td class="fw-300 text-center">
                                                    {{ date('Y-m-d', strtotime($wallet->created_at)) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="mt-1 me-2 btn-close" data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-header">
                        <div class="" style="margin: 0 auto">
                            <img src="{{ asset('images/logo/icon-deg.png') }}" width="70" height="100"
                                class="align-self-center mr-1 di" alt="">
                        </div>
                    </div>
                    <h4 class="modal-title mt-2" id="exampleModalLongTitle" style="margin: 0 auto"><strong>PAMM
                            Application</strong></h4>
                    <div class="modal-body">
                        <p class="text-center mt-1">This process will need to be approved by the administrator, so it could take
                            a moment.</p>
                        <form  method="POST" action="{{ route('savePamm') }}">
                            @csrf
                            <div class="form-group mt-1">
                                <label for="" style="margin-bottom: 1%;" class="fw-500">Trading Account Number</label>
                                <input type="number" name="account_number" class="form-control" placeholder="Enter trading account number">
                            </div>
                            <div class="form-group mt-1">
                                <div class="">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="pdf">
                                   <input type="submit" value="subir">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <a href="{{route('downloadLPOA')}}" class="btn btn-primary">Download LPOA:<svg width="14" style="margin-left: 0.5em" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.4859 3.57292L10.4271 0.514063C10.099 0.185938 9.65417 0 9.19115 0H1.75C0.783854 0.00364583 0 0.7875 0 1.75365V16.9203C0 17.8865 0.783854 18.6703 1.75 18.6703H12.25C13.2161 18.6703 14 17.8865 14 16.9203V4.8125C14 4.34948 13.8141 3.90104 13.4859 3.57292ZM12.1078 4.67031H9.33333V1.89583L12.1078 4.67031ZM1.75 16.9203V1.75365H7.58333V5.54531C7.58333 6.03021 7.97344 6.42031 8.45833 6.42031H12.25V16.9203H1.75ZM9.77448 9.33698C9.56667 9.33698 9.38802 9.48281 9.34792 9.68333C8.59687 13.2453 8.60417 13.1615 8.58229 13.4568C8.575 13.413 8.56771 13.362 8.55677 13.3C8.5276 13.1141 8.56771 13.3073 7.69635 9.6724C7.64896 9.47552 7.47396 9.33698 7.26979 9.33698H6.7849C6.58437 9.33698 6.40937 9.47552 6.35833 9.66875C5.46875 13.2781 5.48333 13.176 5.45417 13.4495C5.45052 13.4094 5.44688 13.3583 5.43594 13.2964C5.41042 13.1068 4.92188 10.624 4.73958 9.68698C4.69948 9.48281 4.52083 9.33333 4.30937 9.33333H3.69687C3.4125 9.33333 3.20469 9.59948 3.27031 9.87292C3.56198 11.0615 4.24375 13.8651 4.48073 14.8313C4.52812 15.0281 4.70312 15.163 4.90729 15.163H5.82604C6.02656 15.163 6.20156 15.0281 6.24896 14.8313L6.90156 12.2281C6.95625 12.0021 6.99271 11.7906 7.01094 11.5974L7.11667 12.2281C7.12031 12.2427 7.57604 14.0693 7.76927 14.8313C7.81667 15.0245 7.99167 15.163 8.19219 15.163H9.09271C9.29323 15.163 9.46823 15.0281 9.51562 14.8313C10.274 11.8453 10.6167 10.4927 10.7734 9.87292C10.8427 9.59583 10.6349 9.32969 10.3505 9.32969H9.77448V9.33698Z" fill="#F8FBFA"/>
                                    </svg>
                                    <svg style="margin-left: 0.5em" width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.4859 3.57292L10.4271 0.514063C10.099 0.185938 9.65417 0 9.19115 0H1.75C0.783854 0.00364583 0 0.7875 0 1.75365V16.9203C0 17.8865 0.783854 18.6703 1.75 18.6703H12.25C13.2161 18.6703 14 17.8865 14 16.9203V4.8125C14 4.34948 13.8141 3.90104 13.4859 3.57292ZM12.1078 4.67031H9.33333V1.89583L12.1078 4.67031ZM1.75 16.9203V1.75365H7.58333V5.54531C7.58333 6.03021 7.97344 6.42031 8.45833 6.42031H12.25V16.9203H1.75ZM10.8719 11.6812C10.4271 11.2437 9.15833 11.3641 8.52396 11.4443C7.89687 11.0615 7.4776 10.5328 7.18229 9.75625C7.32448 9.16927 7.55052 8.27604 7.37917 7.71458C7.22604 6.75938 6.00104 6.85417 5.82604 7.49948C5.66563 8.08646 5.81146 8.90313 6.08125 9.94583C5.71667 10.8172 5.17344 11.9875 4.79062 12.6583C4.06146 13.0339 3.07708 13.6135 2.93125 14.3427C2.81094 14.9187 3.87917 16.3552 5.70573 13.2052C6.5224 12.9354 7.41198 12.6036 8.19948 12.4724C8.88854 12.8443 9.69427 13.0922 10.2339 13.0922C11.1635 13.0922 11.2547 12.0641 10.8719 11.6812ZM3.64948 14.5177C3.83542 14.0182 4.54271 13.4422 4.75781 13.2417C4.0651 14.3464 3.64948 14.5432 3.64948 14.5177ZM6.62448 7.56875C6.89427 7.56875 6.86875 8.73906 6.6901 9.05625C6.52969 8.54948 6.53333 7.56875 6.62448 7.56875ZM5.7349 12.549C6.08854 11.9328 6.39115 11.2 6.63542 10.5547C6.93802 11.1052 7.32448 11.5464 7.73281 11.849C6.97448 12.0057 6.31458 12.3266 5.7349 12.549ZM10.5328 12.3667C10.5328 12.3667 10.3505 12.5854 9.17292 12.0823C10.4526 11.9875 10.6641 12.2792 10.5328 12.3667Z" fill="#F8FBFA"/>
                                    </svg>
                                </a>
                            </div>
                            <div class="modal-footer pb-0">
                                <button type="submit" class="btn btn-primary" style="width: 100%">SEND</button>
                            </div>
                        </form>
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
            $(document).ready(function() {
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
