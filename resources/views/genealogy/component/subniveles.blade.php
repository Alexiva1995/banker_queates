<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        @if ($data->gender == null || $data->gender == 0)
            <img src="{{ asset('images/avatars-profile/1.png') }}" height="70" width="64"
            class="rounded-circle" style="margin-top: -4px" alt="{{ $base->name }}"
            title="{{ $base->name }}">
        @else
            <img src="{{ asset('images/avatars-profile/2.png') }}" height="64" width="64"
            class="rounded-circle " style="margin-top: -4px" alt="{{ $base->name }}"
            title="{{ $base->name }}">
        @endif
        
    </div>
    <div class="media-body">
            <h5 class=""> <b>{{ $data->name }}</b></h5>
    </div>
</a>
