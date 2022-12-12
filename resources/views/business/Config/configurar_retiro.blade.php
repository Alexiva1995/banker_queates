@extends('layouts/contentLayoutMaster')

@section('title', 'Configurar de Retiros')

@section('content')
@include('business.Config.JS.Js_config')
<div class="container">
    <div class="row">
      <div class="col-sm-12 card mb-5" >
        <div class="row" id="config">
            <div class="col-sm-12 ">
                <div class="d-flex justify-content-start fw-bold mt-1">
                    <p>Configurar</p><label style="padding-left: 1%">| Retiros</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12 ">
                            <div class="d-flex justify-content-center fw-bold">
                                <p>Porcentaje de fee a cobrar en los retiros</p>
                            </div>
                        </div>
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >% de Fee</span>
                            <input type="number" value="{{ $WithdrawalSetting->percentage }}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="fee_valor">
                          </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center fw-bold">
                            <p>Dias en los que el retiro estara activo</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent">De</span>
                            <select class="form-select" aria-label="Default select example" id="dia_desde">
                                <option selected value="sinvalor">-------</option>
                                <option value="1" {{ $WithdrawalSetting->day_start == '1' ? 'selected' : '' }} >Lunes</option>
                                <option value="2" {{ $WithdrawalSetting->day_start == '2' ? 'selected' : '' }} >Martes</option>
                                <option value="3" {{ $WithdrawalSetting->day_start == '3' ? 'selected' : '' }} >Miercoles</option>
                                <option value="4" {{ $WithdrawalSetting->day_start == '4' ? 'selected' : '' }} >Jueves</option>
                                <option value="5" {{ $WithdrawalSetting->day_start == '5' ? 'selected' : '' }} >Viernes</option>
                                <option value="6" {{ $WithdrawalSetting->day_start == '6' ? 'selected' : '' }} >Sabado</option>
                                <option value="7" {{ $WithdrawalSetting->day_start == '7' ? 'selected' : '' }} >Domingo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent">A</span>
                            <select class="form-select" aria-label="Default select example" id="dia_hasta">
                                <option selected value="sinvalor">-------</option>
                                <option value="1" {{ $WithdrawalSetting->day_end == '1' ? 'selected' : '' }} >Lunes</option>
                                <option value="2" {{ $WithdrawalSetting->day_end == '2' ? 'selected' : '' }} >Martes</option>
                                <option value="3" {{ $WithdrawalSetting->day_end == '3' ? 'selected' : '' }} >Miercoles</option>
                                <option value="4" {{ $WithdrawalSetting->day_end == '4' ? 'selected' : '' }} >Jueves</option>
                                <option value="5" {{ $WithdrawalSetting->day_end == '5' ? 'selected' : '' }} >Viernes</option>
                                <option value="6" {{ $WithdrawalSetting->day_end == '6' ? 'selected' : '' }} >Sabado</option>
                                <option value="7" {{ $WithdrawalSetting->day_end == '7' ? 'selected' : '' }} >Domingo</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 mb-3">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center fw-bold mt-1">
                            <p>Horario de retios</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >incia</span>
                            <input type="time" value="{{ $WithdrawalSetting->time_start }}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="hora_inicial">
                          </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >Termina</span>
                            <input type="time" value="{{ $WithdrawalSetting->time_end }}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="hora_final">
                          </div>
                    </div>
                </div>
            </div>

            {{--<div class="col-sm-4 mb-3">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center fw-bold mt-1">
                            <p>Transferencias internas</p>
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                        <select id="transferencias_entre_users" class="form-select" aria-label="Default select example">
                            <option value="1"
                            @if ($transferencias_entre_users == 1)
                            selected
                            @endif>Activar</option>
                            <option value="0" @if ($transferencias_entre_users == 0)
                            selected
                            @endif>Desactivar</option>
                        </select>
                    <div class="col-sm-12 ">
                </div>
            </div>--}}
            <div class="col-sm-12 mb-3 ">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary mt-4" onclick="Guardar_configuracion();">Guardar</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
