@extends('layouts/contentLayoutMaster')
@section('title', 'Atendiendo el Ticket')
@section('content')

    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Support</p><span class="fw-normal mx-1">|</span>
        <p>Ticket</p>
    </div>

    <section id="basic-vertical-layouts">
        <div class="row match-height d-flex justify-content-center">
            <div class="col-md-12 col-12">
                <div class="card">
                    <!--Card Header--->
                    <div class="card-header">
                        <h4 class="mt-1 ms-1 fw-bold">
                            Reviewing Ticket of: <span><b>{{ $ticket->getUser->name }}</b></span>
                        </h4>
                    </div>
                    <!--Card Header End--->

                    <div class="card-body mx-5">
                        <form action="{{ route('ticket.update-admin', $ticket->id) }}" method="POST"
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
                                    <span class=" text-bold-600 text-primary">Email:</span>
                                    <span>{{ $emailUser }}</span>
                                </div>
                                <div class="col-6 mb-2">
                                    <!--SELECT-->
                                    <span class=" text-bold-600 text-primary">Categorie: </span>

                                    @if ($ticket->categories == '0')
                                        <span>Help</span>
                                    @elseif($ticket->categories == '1')
                                        <span>Technical support</span>
                                    @elseif($ticket->categories == '2')
                                        <span>Data correction</span>
                                    @elseif($ticket->categories == '3')
                                        <span>Bonus</span>
                                    @elseif($ticket->categories == '4')
                                        <span>Total inversion</span>
                                    @endif
                                    <!--SELECT END-->

                                </div>
                                <div class="col-6 mb-2">
                                    <span class=" text-bold-600 text-primary">Issue:</span>
                                    <span>{{ $ticket->issue }}</span>
                                </div>

                                <div class="col-6 mb-2">
                                    <span class=" text-bold-600 text-primary"># Ticket:</span>
                                    <span>{{ $ticket->id }}</span>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <span class="text-bold-600 text-primary">Status:</span>
                                        <select name="status"
                                            class=" form-select custom-select @error('status') is-invalid @enderror">
                                            <option value="0" @if ($ticket->status == '0') selected @endif>Open
                                            </option>
                                            <option value="1" @if ($ticket->status == '1') selected @endif>Close
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 mb-2">
                                    <!--Asunto -->

                                    <!--Asunto end-->

                                    <!--Chat-->
                                    <div class="card mt-2 pt-5" style="background-color: #D8EDED;">
                                        @foreach ($message as $item)
                                            @if ($item->type == 0)
                                                <div class="d-flex justify-content-start mb-4">
                                                    <div class="ms-3 msg_cotainer"
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
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    width="150" height="150" style="display: none;">
                                                            @endif
                                                        </div>
                                                        <span style="color: #000;"> {{ $item->message }}</span>

                                                    </div>
                                                </div>
                                            @elseif ($item->type == 1)
                                                <div class="d-flex justify-content-end mb-4">
                                                    <div class="me-3 msg_cotainer_send"
                                                        style="background-color: #05A5E9; border-radius: 10px;
                                                    box-shadow: 0px 10px 9px -4px rgba(0,0,0,0.76);">
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
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    width="150" height="150" style="display: none;">
                                                            @endif
                                                        </div>
                                                        <span class="mb-1" style="color: #fff;">
                                                            {{ $item->message }}</span>

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

                                            <input class="form-control " placeholder="Write a message" type="text"
                                                id="message" name="message" style="background-color: #D8EDED;"></input>
                                            <!--MENSAJE END-->
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="d-flex justify-content-around">
                                                <form class="p-0" id="frm-example" name="frm-example">
                                                    <label for="hiddenBtn" class="choose-btn capa-interior" id="chooseBtn"
                                                        style="margin-top: 0.5em;"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M20.75 23.25H3.25C1.86929 23.25 0.75 22.1307 0.75 20.75V3.25C0.75 1.86929 1.86929 0.75 3.25 0.75H20.75C22.1307 0.75 23.25 1.86929 23.25 3.25V20.75C23.25 22.1307 22.1307 23.25 20.75 23.25ZM3.25 3.25V20.75H20.75V3.25H3.25ZM19.5 18.25H4.5L8.25 13.25L9.5 14.5L13.25 9.5L19.5 18.25ZM7.625 10.75C6.58947 10.75 5.75 9.91053 5.75 8.875C5.75 7.83947 6.58947 7 7.625 7C8.66053 7 9.5 7.83947 9.5 8.875C9.5 9.91053 8.66053 10.75 7.625 10.75Z"
                                                                fill="#2E3A59" />
                                                        </svg>
                                                    </label>
                                                    <input type="file" id="hiddenBtn" name="image">
                                                </form>


                                                @error('image')
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->

                                                <!--CONTENEDOR DE ENVIAR Y PAPELERA-->

                                                <button class="btn btn-primary waves-effect waves-float waves-light">Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--CONTENEDOR DE ARCHIVO ADJUNTO-->

                                    <!--CONTENEDOR DE ENVIAR Y PAPELERA END-->
                                    <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                                </div>
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO-->


                                <!--CONTENEDOR DE ENVIAR Y PAPELERA END-->
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
