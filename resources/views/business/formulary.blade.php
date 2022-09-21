@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de Retiros')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')
<div class="card">
	<div class="card-header mb-1">Formulario</div>
	<div class="card-body">
		<form  action="{{ route('formulary-v1') }}" enctype="multipart/form-data" method="POST" required>
            @csrf
            <input type="hidden" name="paquete" value="{{$monto}}">
			<input type="hidden" name="orderId" value="{{ $orderId }}">
			<div class="row">
				<div class="col-sm-4">
	                <label for="name">Nombre del Broker <label style="color: red;">*</label></label>
	                <div class="input-group mb-1">
	                    <input type="text" name="namebroker" class="form-control" required>
	                </div>
	            </div>
	            <div class="col-sm-4">
	                <label for="">Servidor del Broker <label style="color: red;">*</label></label>
	             <div class="input-group mb-1">
	                    <input type="text" name="serverBroker" class="form-control" required>
	                </div>   
	            </div>
	            <div class="col-sm-4">
	                <label for="">Login o number account <label style="color: red;">*</label></label>
	                <div class="input-group mb-1">
	                    <input type="text" name="numberAccount" class="form-control" required>
	                </div>   
	            </div>
	            <div class="col-sm-4">
	                <label for="">Password Real <label style="color: red;">*</label></label>
	                <div class="input-group mb-1">
	                     <input type="text" name="passReal" class="form-control" required>
	                </div>   
	            </div>
	            <div class="col-sm-4">
	                <label for="">Currency <label style="color: red;">*</label></label>
	                <select id="type" class="rounded form-control text-dark" name="currency" required>
                        <option disabled selected >Seleccione una moneda</option>
                        <option value="USD" >USD</option>
                        <option value="EUR" >EUR</option>
                    </select>   
	            </div>
	            <div class="col-sm-4">
	                <label for="">Plataforma de operaciones <label style="color: red;">*</label></label>
	               	<select id="type" class="rounded form-control text-dark" name="plataform" required>
                        <option disabled selected >Seleccione una plataforma</option>
                        <option value="mt4" >mt4</option>
                        <option value="mt5" >mt5</option>
                    </select>      
	            </div>
	            <div class="col-sm-4">
	                <label for="">Monto del deposito <label style="color: red;">*</label></label>
	                <div class="input-group mb-1">
	                    <input type="number" name="amount" class="form-control" required>
	                </div>   
	            </div>
	            <div class="col-sm-4">
	                <label for="">Adjuntar Comprobante <label style="color: red;">*</label></label>
	                <div class="input-group">
	                    <input type="file" name="comprobante" class="form-control" required style="display: unset;">
	                </div>  
	                <label style="margin-top: -0.5rem">capture correo de registro broker.</label> 
	            </div> 
                <div class="col-sm-4">
	                <label for="">Tipo de inversion <label style="color: red;">*</label></label>
	                <select id="type" class="rounded form-control text-dark" name="type" required>
                        <option disabled selected >Seleccione Tipo de inversion</option>
                        <option value="irv_forex" >IRV Forex</option>
                        {{-- <option value="irv_indices_sinteticos" >Irv Indices</option> --}}
                        <option value="cryptos" >Crypto</option>
                    </select>   
	            </div>
	            
	            <div class="col-sm-4">
	        </div>
	        <div class="modal-footer" style="border: none">
	            <button type="submit" class="btn btn-primary">Guardar Registro</button>
	        </div>	
		</form>
	</div>	
</div>
@endsection
