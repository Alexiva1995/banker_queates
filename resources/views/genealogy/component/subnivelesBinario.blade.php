<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}

        @if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="70" width="64"
            class="rounded-circle align-self-center mr-1 di" alt="{{$data['range_id']}}">
        
        @elseif( ($data["range_id"] == null) && (!empty($data->investment->package_id)) )
            <img src="{{ asset('images/ensignLicences/'.$data['range_id'].'.png') }}" height="70" width="64"
            class="rounded-circle align-self-center mr-1 di" alt="{{$data['range_id']}}">
        
        @elseif( ($data["range_id"] == null) && (empty($data->investment->package_id)) )

            @if ($data->gender == null || $data->gender == 0)
                <img src="{{ asset('images/avatars-profile/1.png') }}" height="70" width="64"
                class="rounded-circle" style="margin-top: -4px" alt="{{ $data->name }}"
                title="{{ $data->name }}">
            @else
                <img src="{{ asset('images/avatars-profile/2.png') }}" height="70" width="64"
                class="rounded-circle " style="margin-top: -4px" alt="{{ $data->name }}"
                title="{{ $data->name }}">
            @endif

        @endif
        
    </div>

    <div class="media-body">
            <h6 style="color: #544E67; font-size: 10px"> <b>{{ $data->name }}</b></h6>
    </div>
</a>
