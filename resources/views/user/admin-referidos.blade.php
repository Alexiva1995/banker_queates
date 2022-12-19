@extends('layouts/contentLayoutMaster')

@section('title', 'Unilev1; i <= 10; i++ e
{
}l')
@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('content')
<style>
  .content-input input,
  .content-select select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }
  .content-input input {
    visibility: hidden;
    position: absolute;
    right: 0;
  }
  .content-input {
    position: relative;
    display: block;
    cursor: pointer;
  }
  /* Estas reglas se aplicarán a todos los span despues de un input de tipo radio*/
  .content-input input[type=radio]+span {}
  .content-input input[type=radio]+span:before {
    background-color: #05A5E9;
    color: #fff;
  }
  .content-input input[type=radio]:checked+span {
    background-color: #05A5E9 !important;
    color: #fff;
    border-radius: 5px;
    opacity: 1;
  }
  .content-input:hover input[type=radio]:not(:checked)+span {
    background: #05A5E9;
    color: #fff;
    border-radius: 5px;
  }
  .level-content {
    margin-top: 45px;
    gap: 0.5rem;
    row-gap: 1.8rem;
    justify-content: flex-start;
  }
  .level {
    margin-right: 5px;
    font-size: 15px;
    font-weight: bold;
    padding: 10px 15px;
  }
  .active {
    background-color: #05A5E9;
    color: #fff;
    border-radius: 5px;
  }
  div.dataTables_wrapper div.dataTables_filter label, div.dataTables_wrapper div.dataTables_length label {
    margin-left: 15px;
  }
  .fw-700{
    font-weight: 700!important;
  }
</style>
<div id="logs-list">
  <div class="d-flex my-2">
    <p style="color:#808E9E;" class="fw-700">Auditoria</p><span class="fw-normal mx-1">|</span><p>{{$user->name}}</p>
   </div
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-header d-block p-2 pb-0">
          <h4><b>Red de {{$user->name}}</b></h4>

        </div>
      </div>
      <div class="tabs-wrapper px-2 mb-2">
        <div class="d-flex level-content flex-wrap">
          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_1" value="nivel_1" checked>
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 1</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_2" value="nivel_2">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 2</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_3" value="nivel_3">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 3</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_4" value="nivel_4">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 4</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_5" value="nivel_5">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 5</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_6" value="nivel_6">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 6</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_7" value="nivel_7">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 7</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_8" value="nivel_8">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 8</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_9" value="nivel_9">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 9</span>
          </label>

          <label class="content-input">
            <input type="radio" name="nivel" id="nivel_10" value="nivel_10">
            <span class="level">
                            <svg id="active_icon_1" class="me-50 mb-25" width="15" height="15"
                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.5 14.7318L0.375 9.19015L1.6575 8.19265L7.49208 12.7289L13.3346 8.18473L14.625 9.19015L7.5 14.7318ZM7.5 11.3514L1.66542 6.81515L0.375 5.80973L7.5 0.268066L14.625 5.80973L13.3267 6.81515L7.5 11.3514Z"
                                    fill="white" />
                            </svg>Nivel 10</span>
          </label>

        </div>

        <div class="tab-body-wrapper mt-2">

          <div id="tab-body-1" class="tab-body">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                  <tr>
                    <td>{{"{$user->name} {$user->lastname}"}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{$user->username}}</td>
                    <td>Sin rango</td>
                    <td>Aún No posee</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-2" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                        <tr>
                          <td>{{"{$user->name} {$user->lastname}"}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->username}}</td>
                          <td>Sin rango</td>
                          <td>Aún No posee</td>
                        </tr>
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-3" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                      <tr>
                        <td>{{"{$user->name} {$user->lastname}"}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->username}}</td>
                        <td>Sin rango</td>
                        <td>Aún No posee</td>
                      </tr>
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-4" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                        <tr>
                          <td>{{"{$user->name} {$user->lastname}"}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->username}}</td>
                          <td>Sin rango</td>
                          <td>Aún No posee</td>
                        </tr>
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-5" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                          <tr>
                            <td>{{"{$user->name} {$user->lastname}"}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->username}}</td>
                            <td>Sin rango</td>
                            <td>Aún No posee</td>
                          </tr>
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-6" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                            @foreach ($user->children as $user)
                            <tr>
                              <td>{{"{$user->name} {$user->lastname}"}}</td>
                              <td>{{$user->email}}</td>
                              <td>{{$user->username}}</td>
                              <td>Sin rango</td>
                              <td>Aún No posee</td>
                            </tr>
                            @endforeach
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-7" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                            @foreach ($user->children as $user)
                              @foreach ($user->children as $user)
                              <tr>
                                <td>{{"{$user->name} {$user->lastname}"}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->username}}</td>
                                <td>Sin rango</td>
                                <td>Aún No posee</td>
                              </tr>
                              @endforeach
                            @endforeach
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-8" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                            @foreach ($user->children as $user)
                              @foreach ($user->children as $user)
                                @foreach ($user->children as $user)
                                <tr>
                                  <td>{{"{$user->name} {$user->lastname}"}}</td>
                                  <td>{{$user->email}}</td>
                                  <td>{{$user->username}}</td>
                                  <td>Sin rango</td>
                                  <td>Aún No posee</td>
                                </tr>
                                @endforeach
                              @endforeach
                            @endforeach
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-9" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                            @foreach ($user->children as $user)
                              @foreach ($user->children as $user)
                                @foreach ($user->children as $user)
                                  @foreach ($user->children as $user)
                                  <tr>
                                    <td>{{"{$user->name} {$user->lastname}"}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>Sin rango</td>
                                    <td>Aún No posee</td>
                                  </tr>
                                  @endforeach
                                @endforeach
                              @endforeach
                            @endforeach
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

          <div id="tab-body-10" class="tab-body d-none">
            <div class="table-responsive">
              <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                <thead>
                  <tr>
                    <th>Nombre y Apellido</th>
                    <th>Usuario</th>
                    <th>Pais</th>
                    <th>Rango</th>
                    <th>Puntos Grupales</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($referals_childrens as $user)
                    @foreach ($user->children as $user)
                      @foreach ($user->children as $user)
                        @foreach ($user->children as $user)
                          @foreach ($user->children as $user)
                            @foreach ($user->children as $user)
                              @foreach ($user->children as $user)
                                @foreach ($user->children as $user)
                                  @foreach ($user->children as $user)
                                    @foreach ($user->children as $user)
                                    <tr>
                                      <td>{{"{$user->name} {$user->lastname}"}}</td>
                                      <td>{{$user->email}}</td>
                                      <td>{{$user->username}}</td>
                                      <td>Sin rango</td>
                                      <td>Aún No posee</td>
                                    </tr>
                                    @endforeach
                                  @endforeach
                                @endforeach
                              @endforeach
                            @endforeach
                          @endforeach
                        @endforeach
                      @endforeach
                    @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection
@section('page-script')
<script></script>
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
  $('#nivel_1').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-1').removeClass('d-none');
  });
  $('#nivel_2').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-2').removeClass('d-none');
  });
  $('#nivel_3').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-3').removeClass('d-none');
  });
  $('#nivel_4').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-4').removeClass('d-none');
  });
  $('#nivel_5').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-5').removeClass('d-none');
  });
  $('#nivel_6').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-6').removeClass('d-none');
  });
  $('#nivel_7').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-7').removeClass('d-none');
  });
  $('#nivel_8').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-8').removeClass('d-none');
  });
  $('#nivel_9').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-9').removeClass('d-none');
  });
  $('#nivel_10').click(()=>{
    for(i = 1; i <= 10; i++ )
    {
      $('#tab-body-'+i).addClass('d-none');
    }
    $('#tab-body-10').removeClass('d-none');
  });
  $('.myTable').DataTable({
    responsive: true,
    order: [
        [0, 'desc']
    ],
  })
</script>

<script>
  let span = document.getElementById('span');
        let enviar = 'Enviar';
        let enviado = 'Enviado';
        span.innerHTML = enviar;
        function sendCodeEmail() {
            let url = 'aprobarRetiro'
            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                    if (IsNumeric(response) == true) {
                        $('#idLiquidation').val(response)
                        span.innerHTML = enviado;
                        toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
                            "progressBar": true
                        });
                    } else {
                        toastr.error("El monto minimo de retiro es 60 usdt", '¡Error!', {
                            "progressBar": true
                        });
                    }
                }).catch(function(error) {
                    console.log(error);
                    toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
                        "progressBar": true
                    });
                })
        }
        function IsNumeric(val) {
            return Number(parseFloat(val)) === val;
        }
        //REESTAURA VALOR DE CAMPOS
        $("#restaurar").click(function() {
            setTimeout(function() {
                window.location = '{{ route('wallet.index') }}';
            });
        });
</script>

@endsection
