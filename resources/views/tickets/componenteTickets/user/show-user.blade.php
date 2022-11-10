@extends('layouts/contentLayoutMaster')
@section('title', 'Editando ticket')

@section('content')

<div class="title mb-5">
    <p class="rosado">Soporte <br> Ticket</p>
</div>

<div class="row match-height">
    <div class="col-md-12 col-12">
        <div class="card">
            <!--Card Header--->
            <div class="card-header">
                <h4 class="fw-bold">
                    Revisando Ticket
                </h4>
            </div>
            <!--Card Header End--->

            <div class="card-body">
                <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-sm-6 mb-1">
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

                        <div class="col-sm-6 mb-2">
                            <label for="">Estado:</label>
                            @if($ticket->status == '0')
                            <h5>Abierto</h5>
                            @endif
                            @if($ticket->status == '1')
                            <h5>Cerrado</h5>
                            @endif
                        </div>

                        {{-- <div class="col-sm-6">
                            <!--INPUT DE PRIORIDADES-->
                            <label for="">Prioridad:</label>
                            @if ($ticket->priority == '0')
                            <input type="text" class="form-control" value="Alta" disabled>
                            @elseif($ticket->priority == '1')
                            <input type="text" class="form-control" value="Media" disabled>
                            @elseif($ticket->priority == '2')
                            <input type="text" class="form-control" value="Baja" disabled>
                            @endif
                            <!--INPUT DE PRIORIDADES END-->
                        </div> --}}

                        <div class="col-sm-12 mb-2">
                            <!--Asunto -->
                            <span class=" text-bold-600">Asunto:</span>
                            <div class="input-group input-group-lg">
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
                    </div>
            </div>
        </div>


        @endsection
