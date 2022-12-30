@extends('layouts/contentLayoutMaster')
@section('title', 'Editando ticket')

@section('content')
<style type="text/css">
    .card {
            border: 1px solid #05B1D966 !important;
            border-radius: 10px !important;
    }
</style>
    <div class="d-flex my-2">
        <p style="color:#808E9E;" class="fw-700">Support</p><span class="fw-normal mx-1 text-primary">|</span>
        <p>Ticket</p>
    </div>

    <div class="row match-height">
        <div class="col-md-12 col-12">
            <div class="card">
                <!--Card Header--->
                <div class="card-header">
                    <h4 class="fw-bold">
                        Reviewing Ticket
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

                            <div class="col-6 mb-2">
                                <label class="text-primary" for="">Status:</label>
                                @if ($ticket->status == '0')
                                    <span>Open</span>
                                @endif
                                @if ($ticket->status == '1')
                                    <span>Close</span>
                                @endif
                            </div>
                            <div class="col-sm-12 mb-2">
                                <!--Asunto -->

                                <!--Asunto end-->

                                <!--Chat-->
                                <div class="card pt-5" style="background-color: #D8EDED;">
                                    @foreach ($message as $item)
                                        @if ($item->type == 0)
                                            <div class="d-flex justify-content-end mb-4">
                                                <div class="me-2 msg_cotainer" style="border-radius: 10px; background-color: #05A5E9; color: rgb(0, 0, 0); box-shadow: 0px 10px 9px -4px rgba(0,0,0,0.76);">
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
                                                    <span style="color: #fff;"> {{ $item->message }}</span>

                                                </div>
                                            </div>
                                        @elseif ($item->type == 1)
                                            <div class="title2 d-flex justify-content-start">
                                                
                                            </div>
                                            <div class="d-flex justify-content-start mb-4">
                                                <div class="ms-2 msg_cotainer_send" style="background-color: #E3E7EB; border-radius: 10px;
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
                                                                src="{{ asset('storage/' . $item->image) }}" width="150"
                                                                height="150" style="display: none;">
                                                        @endif
                                                    </div>
                                                    <span class="mb-1" style="color: #000;"> {{ $item->message }}</span>

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
