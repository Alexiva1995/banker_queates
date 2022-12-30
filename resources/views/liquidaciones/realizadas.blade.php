@extends('layouts/contentLayoutMaster')

@section('title', 'Liquidaciones')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.css">
@endsection
@section('page-style')
{{--
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')
<!-- Statistics card section -->
<section class="row">
  <style>
    .ms-choice{
        margin: -3px;
        border: none !important;
    }
  </style>
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->
  @if (Auth::user()->admin == 0)
  <div class="col-12">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title">Liquidactions</h4>
        <div class="d-flex align-items-center">
          <p class="card-text me-25 mb-0">{{date('m-Y')}}</p>
        </div>
      </div>

    </div>
  </div>
  @endif
  @if (Auth::user()->admin == 1)
  <div class="col-lg-12 col-12">
    @else
    <div class="col-lg-12 col-12">
      @endif
      <div id="logs-list">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-header">
                <h4 class="fw-700">Done Liquidactions</h4>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button"
                  aria-expanded="false" aria-controls="collapseExample">
                  Filters
                </a>
              </div>

              <div class="card-body card-dashboard">
                <div class="collapse" id="collapseExample">
                  <form action="{{ route('liquidaciones.realizadas.filter') }}" method="POST" class="mt-2">
                    @csrf
                    <div class="row">

                      <div class="mb-2 col-md-6 col-sm-12">
                        <label for="user_id" class="form-label">ID User</label>
                        <input type="number" class="form-control" id="user_id" name="user_id" @if($user_id !=null)
                          value="{{$user_id}}" @endif">
                      </div>

                      <div class="mb-2 col-md-6 col-sm-12">
                        <label for="user_name" class="form-label">User</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" 
                        @if($user_name !=null) value="{{$user_name}}" @endif>
                      </div>

                      <div class="mb-2 col-md-6 col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                        @if($email !=null) value="{{$email}}" @endif>
                      </div>

                      <div class="mb-2 col-md-6 col-sm-12">
                        <label for="hash" class="form-label">Hash</label>
                        <input type="text" class="form-control" id="hash" name="hash" 
                        @if($hash !=null) value="{{$hash}}" @endif>
                      </div>

                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a class="btn btn-info" href="{{route('liquidaciones.realizadas')}}">Clear Filters</a>
                        {{-- <a class="btn btn-info" id="btn_clear">Limpiar filtros</a> --}}
                      </div>

                    </div>
                  </form>
                </div>
                <div class="table-responsive">
                  <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                    <thead class="">

                      <tr class="text-center">
                        <th>ID</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Gross Amount</th>
                        <th>Fee</th>
                        <th>Amount to receive</th>
                        <th>Wallet</th>
                        <th>HASH</th>
                        <th>Status</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($liquidaciones))
                      @foreach ($liquidaciones as $liquidacion)
                      <tr class="text-center">
                        <td>{{$liquidacion->id}}</td>
                        <td>{{$liquidacion->user->name}}</td>
                        <td>{{$liquidacion->user->email}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_gross,2)}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_fee,2)}}</td>
                        <td class="text-end">{{number_format($liquidacion->amount_net,2)}}</td>
                        <td>{{($liquidacion->wallet_used)}}</td>
                        <td>{{($liquidacion->hash)}}</td>
                        <td>
                          @if ($liquidacion->status == '1')
                          <span class="badge bg-success">Done</span>
                          @endif
                        </td>
                        <td>{{date('d-m-Y', strtotime($liquidacion->created_at))}}</td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--/ Line Chart Card -->
</section>
<!--/ Statistics Card section-->


@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="https://cdn.rawgit.com/wenzhixin/multiple-select/e14b36de/multiple-select.js"></script>
@endsection
@section('page-script')
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
  $(".multiple").multipleSelect({
    filter: false
  });
  //datataables ordenes
  $('.myTable').DataTable({
        responsive: false,
        order: [[ 0, "desc" ]],
        pagingType: 'simple_numbers',
    })
</script>

@endsection