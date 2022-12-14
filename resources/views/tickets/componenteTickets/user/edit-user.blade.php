@extends('layouts/contentLayoutMaster')
@section('title', 'Editando ticket')

@section('content')
<style >
    .card{
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
    }
</style>
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Soporte</p><span class="fw-normal mx-1">|</span>
        <p>Ticket</p>
    </div>

    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ticket.update-user', $ticket->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-6 mb-2">
                                <!--SELECT-->
                                <span class=" text-bold-600 text-primary">ID User: </span>
                                <span>{{Auth::user()->id}}</span>
                            </div>
                            <div class="col-6 mb-2">
                                <span class=" text-bold-600 text-primary">Correo:</span>
                                <span>{{ $emailUser }}</span>
                            </div>
                            <div class="col-6 mb-2">
                                <!--SELECT-->
                                <span class=" text-bold-600 text-primary">Categoria: </span>

                                @if ($ticket->categories == '0')
                                    <span>Ayuda</span>
                                @elseif($ticket->categories == '1')
                                    <span>Soporte técnico</span>
                                @elseif($ticket->categories == '2')
                                    <span>Corrección de datos</span>
                                @elseif($ticket->categories == '3')
                                    <span>Bonos</span>
                                @elseif($ticket->categories == '4')
                                    <span>Inversión total</span>
                                @endif
                                <!--SELECT END-->
                                
                            </div>
                            <div class="col-6 mb-2">
                            <span class=" text-bold-600 text-primary">Asunto:</span>
                                <span>{{ $ticket->issue }}</span>
                            </div>

                            <div class="col-6 mb-2">
                                <span class=" text-bold-600 text-primary"># Ticket:</span>
                                <span>{{ $ticket->id }}</span>
                            </div>

                            <div class="col-6 mb-2">
                                <label class="text-primary" for="">Estado:</label>
                                @if ($ticket->status == '0')
                                    <span>Abierto</span>
                                @endif
                                @if ($ticket->status == '1')
                                    <span>Cerrado</span>
                                @endif
                            </div>

                            <div class="col-sm-12 mb-2">
                                <!--Asunto -->
                                
                                <!--Asunto end-->

                                <!--Chat-->
                                <span class="text-bold-600">Chat:</span>

                                <div class="card-body mb-1">
                                    @foreach ($message as $item)
                                        @if ($item->type == 0)
                                            <div class="title1 ml-2 d-flex justify-content-start">
                                                <span>{{ $item->getUser->email }}</span>
                                            </div>
                                            <div class="d-flex justify-content-start mb-4">
                                                <div class="msg_cotainer">
                                                    <div class="img">
                                                        @if ($item->image !== null)
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <img class="rounded mb-1"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    width="100%" height="150">
                                                            </a>
                                                        @else
                                                            <img class="rounded"
                                                                src="{{ asset('storage/' . $item->image) }}" width="150"
                                                                height="150" style="display: none;">
                                                        @endif
                                                    </div>
                                                    <span> {{ $item->message }}</span>

                                                </div>
                                            </div>
                                        @elseif ($item->type == 1)
                                            <div class="title2 d-flex justify-content-end">
                                                <span>{{ $item->getAdmin->email }}</span>
                                            </div>
                                            <div class="d-flex justify-content-end mb-4">
                                                <div class="msg_cotainer_send">
                                                    <div class="img">
                                                        @if ($item->image !== null)
                                                            <a href="{{ asset('storage/' . $item->image) }}"
                                                                target="_blank">
                                                                <img class="rounded mb-1"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    width="100%" height="150">
                                                            </a>
                                                        @else
                                                            <img class="rounded"
                                                                src="{{ asset('storage/' . $item->image) }}" width="150"
                                                                height="150" style="display: none;">
                                                        @endif
                                                    </div>
                                                    <span class="mb-1"> {{ $item->message }}</span>

                                                </div>
                                            </div>

                                            <!--Chat End-->
                                        @endif
                                    @endforeach
                                </div>
                            </div>


                            <div class="col-sm-12"> 
                                
                                <div class="d-flex justify-content-between">
                                <div class="col-sm-10">
                                <!--MENSAJE-->
                                
                                <input class="ms-2 form-control " placeholder="Escriba un mensaje" type="text" id="message" name="message"></input>
                                <!--MENSAJE END-->
                                </div>
                                <div class="col-sm-1">
                                    <div class="d-flex justify-content-center">
                                    <form class="p-0" id="frm-example" name="frm-example">
                                        <span for="hiddenBtn" class="ms-1 choose-btn capa-interior" id="chooseBtn"><i data-feather='image'></i></span>
                                        <input type="file" id="hiddenBtn" name="image">
                                    </form>
                                    
                               
                                @error('image')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                                <br>

                                <!--CONTENEDOR DE ENVIAR Y PAPELERA-->
                                  
                                    <button
                                        class="btn btn-primary waves-effect waves-float waves-light">Enviar</button>
                                        </div>
                                 </div>
                            </div>
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO-->
                                
                                <!--CONTENEDOR DE ENVIAR Y PAPELERA END-->
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
