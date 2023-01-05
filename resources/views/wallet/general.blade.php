<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="nav-licen-tab">
    <div class="contenedor">
        <div class="row">
            <div class="col-sm-3">
                <div class="card p-2 entrada-bloc">
                    <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                        <div class="avatar-content">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                                    fill="#04D99D" />
                            </svg>
                        </div>
                    </div>

                    <div class="texto" style="padding-left: 3%">
                        <span class="usdt-color" style="font-weight:900; font-size: 21px ">USDT  <span class="text-success">
                            {{$generalTotal > 0 ? number_format($generalTotal, 2, ',', ' ') : 0}} 
                        </span></span>
                        <br>
                        <span class="text-light" style="font-size: 13px;">Total Gain</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card p-2 entrada-bloc ">
                    <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                        <div class="avatar-content">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                                    fill="#04D99D" />
                            </svg>
                        </div>
                    </div>

                    <div class="texto" style="padding-left: 3%">
                        <span class="usdt-color" style="font-weight:900; font-size: 21px">USDT
                            {{ $generalAvailable > 0 ? number_format($generalAvailable, 2, ',', ' ') : 0 }}
                        </span>
                        <br>
                        <span class="text-light">Balance Available</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card p-2 entrada-bloc ">
                    <div class="avatar bg-light-primary avatar-md me-auto mb-1" style="padding: 0.3rem !important">
                        <div class="avatar-content">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 18H2C0.89543 18 0 17.1046 0 16V2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18ZM2 2V16H16V2H2ZM14 14H12V7H14V14ZM10 14H8V4H10V14ZM6 14H4V9H6V14Z"
                                    fill="#04D99D" />
                            </svg>
                        </div>
                    </div>

                    <div class="texto" style="padding-left: 3%">
                        <span id="pamm_balance" class="usdt-color" style="font-weight:900; font-size: 21px">USDT 0
                        </span>
                        <br>
                        <span class="text-light">PAMM Account Balance</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="p-2 entrada-bloc ">
                    <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end w-100" style="margin-bottom:6%;">Request Withdrawal</a>
                    <a type="button" data-bs-toggle="modal" data-bs-target="#modalWallet" class="btn btn-primary float-end w-100" style="margin-bottom:5%">
                        <span style="font-size: 14px; font-weight: 500;">
                            {{ auth()->user()->wallet != null ? 'Change Wallet' : 'Link Wallet'}}
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <h4 class="fw-700" style="margin-left: 2%">Gains</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body card-dashboard p-1">
                    <div class="table-responsive">
                        <table class="table   nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="d-none d-sm-table-cell">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $general as $key => $gen)
                                     <tr class="text-center">
                                        @if ($gen->type == 1)
                                            <td>License bonus</td>
                                        @else
                                            <td> {{ $gen->description }}</td>
                                        @endif
                                        <td> {{ number_format($gen->amount, 2) }}</td>
                                        <td>
                                            @if ($gen->status == '0')
                                                <span class="badge success-badge">
                                                    <span class="text-success">Available</span>
                                                </span>
                                            @elseif($gen->status == '1')
                                                <span class="badge waiting-badge">
                                                    <span class="waiting-text">Requested</span>
                                                </span>
                                            @elseif($gen->status == '2')
                                                <span class="badge success-badge">
                                                    <span class="success-text">Paid</span>
                                                </span>
                                            @elseif($gen->status == '3')
                                                <span class="badge warning-badge">
                                                    <span class="warning-text">Canceled</span>
                                                </span>
                                            @elseif($gen->status == '4')
                                                <span class="badge warning-badge">
                                                    <span class="text-warning">Substracted</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ date('d-m-Y', strtotime($gen->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('business.componentes.Modal.Retiros.setWalletModal')
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col-sm-6 p-2">
                            <h4 class="fw-700" style="margin-left: 2%">Withdrawal</h4>
                        </div>
                        {{--<div class="col-sm-6">
                            <a href="{{route('solicitudesRetiros')}}" class="btn btn-primary float-end">Solicitar Retiro</a>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalWallet" class="btn btn-gradient-primary float-end ms-1">Link Wallet</button>
                        </div>--}}
                    </div>
                </div>
                <div class="card-body card-dashboard p-1">
                    <div class="table-responsive ">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="d-none d-sm-table-cell">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $balancEdition  as $key => $gen)
                                     <tr class="text-center">
                                        @if ($gen->type != 3)
                                            <td> Withdrawal </td>
                                        @else
                                            <td> {{ $gen->description }}</td>
                                        @endif
                                        <td> {{ number_format($gen->amount_gross, 2) }}</td>
                                        <td>
                                            @if ($gen->status == '0')
                                                <span class="badge waiting-badge">
                                                    <span class="waiting-text">Pending</span> 
                                                </span>
                                            @elseif($gen->status == '1')
                                                <span class="badge success-badge">
                                                    <span class="success-text">Paid</span> 
                                                </span>
                                            @elseif($gen->status == '2')
                                                <span class="badge warning-badge">
                                                    <span class="warning-text">Canceled</span> 
                                                </span>
                                            @endif
                                        </td>
                                        <td class="d-none d-sm-table-cell">
                                            {{ date('d-m-Y', strtotime($gen->created_at)) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('business.componentes.Modal.Retiros.setWalletModal')
            </div>
    

        </div>
    </div>
</div>

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    @endsection
    @section('page-script')
    {{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
    <script>
        
        //datataables ordenes
        $('.myTable').DataTable({
            responsive: false,
            order: [
                [0, 'desc']
            ],
            pagingType: 'simple_numbers',
        })
    </script>
@endsection
