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
                    <p>Setting</p><label style="padding-left: 1%">| Withdrawal</label>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12 ">
                            <div class="d-flex justify-content-center fw-bold">
                                <p>Fee percentage to be collected on withdrawals</p>
                            </div>
                        </div>
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >% Fee</span>
                            <input type="number" value="{{ $WithdrawalSetting->percentage }}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="fee_valor">
                          </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center fw-bold">
                            <p>Days in which the withdrawal will be active</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent">From</span>
                            <select class="form-select" aria-label="Default select example" id="dia_desde">
                                <option selected value="sinvalor">-------</option>
                                <option value="1" {{ $WithdrawalSetting->day_start == '1' ? 'selected' : '' }} >Monday</option>
                                <option value="2" {{ $WithdrawalSetting->day_start == '2' ? 'selected' : '' }} >Tuesday</option>
                                <option value="3" {{ $WithdrawalSetting->day_start == '3' ? 'selected' : '' }} >Wednesday</option>
                                <option value="4" {{ $WithdrawalSetting->day_start == '4' ? 'selected' : '' }} >Thursday</option>
                                <option value="5" {{ $WithdrawalSetting->day_start == '5' ? 'selected' : '' }} >Friday</option>
                                <option value="6" {{ $WithdrawalSetting->day_start == '6' ? 'selected' : '' }} >Saturday</option>
                                <option value="7" {{ $WithdrawalSetting->day_start == '7' ? 'selected' : '' }} >Sunday</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent">A</span>
                            <select class="form-select" aria-label="Default select example" id="dia_hasta">
                                <option selected value="sinvalor">-------</option>
                                <option value="1" {{ $WithdrawalSetting->day_end == '1' ? 'selected' : '' }} >Monday</option>
                                <option value="2" {{ $WithdrawalSetting->day_end == '2' ? 'selected' : '' }} >Tuesday</option>
                                <option value="3" {{ $WithdrawalSetting->day_end == '3' ? 'selected' : '' }} >Wednesday</option>
                                <option value="4" {{ $WithdrawalSetting->day_end == '4' ? 'selected' : '' }} >Thursday</option>
                                <option value="5" {{ $WithdrawalSetting->day_end == '5' ? 'selected' : '' }} >Friday</option>
                                <option value="6" {{ $WithdrawalSetting->day_end == '6' ? 'selected' : '' }} >Saturday</option>
                                <option value="7" {{ $WithdrawalSetting->day_end == '7' ? 'selected' : '' }} >Sunday</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 mb-3">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="d-flex justify-content-center fw-bold mt-1">
                            <p>Retirement hours</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >Start</span>
                            <input type="time" value="{{ $WithdrawalSetting->time_start }}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" id="hora_inicial">
                          </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group ">
                            <span class="input-group-text bg-transparent" >End</span>
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
                    <button class="btn btn-primary mt-4" onclick="Guardar_configuracion();">Save</button>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection
