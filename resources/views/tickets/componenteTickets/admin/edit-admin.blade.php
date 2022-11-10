@extends('layouts/contentLayoutMaster')
@section('title', 'Atendiendo el Ticket')
@section('content')

<div class="title mb-5">
    <p class="rosado">Soporte <br> Ticket</p>
</div>

<section id="basic-vertical-layouts">
    <div class="row match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card">
                <!--Card Header--->
                <div class="card-header">
                    <h4 class=" fw-bold">
                        Revisando Ticket de: <span><b>{{$ticket->getUser->name}}</b></span>
                    </h4>
                </div>
                <!--Card Header End--->

                <div class="card-body">
                    <form action="{{route('ticket.update-admin', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <!--SELECT-->
                                <span class=" text-bold-600">Categoria:</span>

                                @if ($ticket->categories == '0')
                                <h5>Ayuda</h5>
                                @elseif($ticket->categories == '1')
                                <h5>Soporte técnico</h5>
                                @elseif($ticket->categories == '2')
                                <h5>Corrección de datos</h5>
                                @elseif($ticket->categories == '3')
                                <h5>Bonos</h5>
                                @elseif($ticket->categories == '4')
                                <h5>Inversión total</h5>
                                @endif
                                <!--SELECT END-->
                            </div>

                            <div class="col-sm-6 mb-2">
                                <span class=" text-bold-600">Correo:</span>
                                <h5>{{$emailUser}}</h5>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <span class=" text-bold-600"># Ticket:</span>
                                <h5>{{$ticket->id}}</h5>
                            </div>

                            {{-- <div class="col-sm-4">
                                <!--INPUT DE PRIORIDADES-->
                                <label for="">Prioridad:</label>
                                @if ($ticket->priority == '0')
                                <input type="text" class="form-control " value="Alta" disabled>
                                @elseif($ticket->priority == '1')
                                <input type="text" class="form-control " value="Media" disabled>
                                @elseif($ticket->priority == '2')
                                <input type="text" class="form-control " value="Baja" disabled>
                                @endif
                                <!--INPUT DE PRIORIDADES END-->
                            </div> --}}

                            <div class="col-sm-6 mb-2">
                                <label for="">Estado:</label>
                                <select name="status" class="form-select custom-select @error('status') is-invalid @enderror">
                                    <option value="0" @if($ticket->status == '0') selected @endif>Abierto</option>
                                    <option value="1" @if($ticket->status == '1') selected @endif>Cerrado</option>
                                </select>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <!--Asunto -->
                                <span class=" text-bold-600">Asunto:</span>
                                <div class="input-group input-group-lg mb-2">
                                    <h5>{{$ticket->issue}}</h5>
                                </div>
                                <!--Asunto end-->
                                <!--Chat-->
                                <span class="text-bold-600">Chat:</span>

                                <div class="card-body msg_card_body">
                                    @foreach ( $message as $item )
                                    @if ($item->type == 0)
                                    <div class="title1 ml-2 d-flex justify-content-start">
                                        <span>{{ $item->getUser->email}}</span>
                                    </div>
                                    <div class="d-flex justify-content-start mb-4">
                                        <div class="msg_cotainer">
                                            <div class="img">
                                                @if($item->image !== NULL)
                                                <a href="{{asset('storage/'.$item->image)}}" target="_blank">
                                                    <img class="rounded mb-1" src="{{asset('storage/'.$item->image)}}" width="100%" height="150">
                                                </a>
                                                @else
                                                <img class="rounded" src="{{asset('storage/'.$item->image)}}" width="150" height="150" style="display: none;">
                                                @endif
                                            </div>
                                            <span> {{ $item->message }}</span>

                                        </div>
                                    </div>
                                    @elseif ($item->type == 1)
                                    <div class="title2 d-flex justify-content-end">
                                        <span>{{ $item->getAdmin->email}}</span>
                                    </div>
                                    <div class="d-flex justify-content-end mb-4">
                                        <div class="msg_cotainer_send">
                                            <div class="img">
                                                @if($item->image !== NULL)
                                                <a href="{{asset('storage/'.$item->image)}}" target="_blank">
                                                    <img class="rounded mb-1" src="{{asset('storage/'.$item->image)}}" width="100%" height="150">
                                                </a>
                                                @else
                                                <img class="rounded" src="{{asset('storage/'.$item->image)}}" width="150" height="150" style="display: none;">
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

                            <div class="col-sm-8">
                                <!--MENSAJE-->
                                <span class=" text-bold-600">Mensaje:</span>
                                <textarea class="form-control " type="text" id="message" name="message" rows="3" style="height: 25vh;"></textarea>
                                <!--MENSAJE END-->
                            </div>

                            <div class="col-sm-4 mt-2">
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO-->
                                <div class="container-fluid capa-exterior">

                                    <form id="frm-example" name="frm-example">
                                        <label for="hiddenBtn" class="choose-btn capa-interior" id="chooseBtn"><i class="fas fa-upload rosado"></i> Ajuntar archivo</label>
                                        <input type="file" id="hiddenBtn" name="image" accept="image/*">
                                    </form>
                                    <br>
                                </div>
                                @error('image')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror

                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                                <br>
                                <!--CONTENEDOR DE ENVIAR Y PAPELERA-->
                                <div class="row mt-1">

                                    <div class="col-sm-12">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <!--BOTON ENVIAR-->
                                                <button class="btn btn-success">Enviar</button>
                                            </div>
                    </form>

                    <div class="col-4">
                        <!--BOTON ELIMINAR-->

                        <span class="rosado" style="font-size: 20px;">
                            | <i id="remove" class=" far fa-trash-alt"></i>
                        </span>
                        <!--BOTON ELIMINAR END-->
                    </div>
                </div>
            </div>

        </div>

        <!--CONTENEDOR DE ENVIAR Y PAPELERA END-->
    </div>
    <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
    </div>
    </div>
    </div>
    </div>
</section>

@endsection
