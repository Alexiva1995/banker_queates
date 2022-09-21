@extends('layouts/contentLayoutMaster')

@section('title', 'Configuración de Retiros')
<style>
    .fw-700{
        font-weight: 700!important;
    }
</style>
@section('content')
<div id="logs-list d-flex justify-content-center">
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Configuraciones</p><span class="fw-normal mx-1">|</span><p>Retiros</p>
    </div>
    <div class="container-fluid">
        <div class="row match-height">
            <div class="col-12 col-md-8">
                <div class="card p-2">
                    <div class="card-content">
                        <div class="card-header p-0">
                            <h4 class="fw-700 ms-1">Días y horas</h4>
                        </div>
                        <div class="card-body card-dashboard">
                            <form method="POST" action="{{ route('settings.update', $config->id) }}" novalidate>
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="type" value="days">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="day_start">Día de inicio:</label>
                                        <select class="select2 form-control" name="day_start"
                                            data-toggle="select" class="form-control">
                                            @foreach ($days as $day)
                                                <option value="{{$day['day_number']}}" {{$config->day_start == $day['day_number'] ? 'selected' : ''}}>{{$day['day_text']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="day_end">Día de cierre:</label>
                                        <select class="select2 form-control" name="day_end"
                                            data-toggle="select" class="form-control">
                                            @foreach ($days as $day)
                                                <option value="{{$day['day_number']}}" {{$config->day_end== $day['day_number'] ? 'selected' : ''}}>{{$day['day_text']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <label for="day_end">Hora de inicio:</label>
                                        <input type="time" class="form-control" name="time_start" value="{{$config->time_start}}"/>
                                    </div>
                                    <div class="col-12 col-md-6 mt-1">
                                        <label for="day_end">Hora de cierre:</label>
                                        <input type="time" class="form-control" name="time_end" value="{{$config->time_end}}"/>
                                    </div>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button class="btn btn-primary" type="submit">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-2">
                    <div class="card-content">
                        <div class="card-header p-0">
                            <h4 class="fw-700 ms-1">Comisión</h4>
                        </div>
                        <div class="card-body card-dashboard">
                            <form method="POST" action="{{ route('settings.update', $config->id) }}" novalidate>
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="type" value="percentaje">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-12 col-md-6">
                                        <label for="percentaje">Porcentaje:</label>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="percentage" value="{{$config->percentage}}">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                          </div>
                                        
                                    </div>
                                    <div class="d-flex justify-content-end align-items-end mt-2">
                                        <button class="btn btn-primary" type="submit">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection