<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        @if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="80" width="70"
            class="rounded-circle-add"  style="margin-top: -2px" alt="{{$data['range_id']}}">
        @elseif($base['range_id'] == null && !empty($base->licence))
            <img src="{{ asset('images/ensignLicences/' . $base['range_id'] . '.png') }}"
            height="80" width="70"
            class="rounded-circle"  style="margin-top: -2px" alt="{{$data['range_id']}}">
        @elseif ( ($data["range_id"] == null) && (empty($data->investment->package_id)) )
            <img src="{{ asset('images/ensignRanges/0.png') }}" height="80" width="70"
            class="rounded-circle-add"  style="margin-top: -2px" alt="{{ $data->name }}"
            title="{{ $data->name }}">
        @endif
    </div>|
    <div class="media-body">
            <h5 style="font-size: 0.8rem"> <b>{{ $data->name }}</b></h5>
    </div>
</a>

