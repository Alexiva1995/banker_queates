@extends('layouts/contentLayoutMaster')
@section('title', 'Editando ticket')

@section('content')

    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Soporte</p><span class="fw-normal mx-1">|</span>
        <p>Ticket</p>
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
                    <form action="{{ route('ticket.update-user', $ticket->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-6 mb-2">
                                <!--SELECT-->
                                <span class=" text-bold-600 text-primary">ID User: </span>
                                <span>{{ Auth::user()->id }}</span>
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
                                <div class="mb-1">
                                    @foreach ($message as $item)
                                        @if ($item->type == 0)
                                            <div class="title1 ml-2 d-flex justify-content-end">
                                                <span>{{ $item->getUser->email }}</span>
                                            </div>
                                            <div class="d-flex justify-content-end mb-4">
                                                <div class="msg_cotainer"
                                                    style="border-radius: 10px; background-color: #E3E7EB; color: rgb(0, 0, 0); box-shadow: 0px 10px 9px -4px rgba(0,0,0,0.76);">
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
                                            <div class="title2 d-flex justify-content-start">
                                                <span>{{ $item->getAdmin->email }}</span>
                                            </div>
                                            <div class="d-flex justify-content-start mb-4">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
