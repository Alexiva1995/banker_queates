@if ( ($data["range_id"] == null) && (empty($data->investment->package_id)) )
    <img src="{{ asset('images/logo/icon-deg.png') }}" height="50" width="45"
    class="" style="margin-top: -4px" alt="{{ $data->name }}"
    title="{{ $data->name }}">
    <h6 style="color: #544E67; font-size: 10px"> <b>{{ $data->name }}</b></h6>
@else
<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media d-flex justify-content-center ">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
        @if( ($data["range_id"] != null) )
            <img src="{{ asset('images/ensignRanges/'.$data['range_id'].'.png') }}" height="80" width="70"
            class="rounded-circle" style="margin-top: -2px" alt="{{$data['range_id']}}">
        
        @elseif( ($data["range_id"] == null) && (empty($data->investment->package_id)) )
            <img src="{{ asset('images/logo/icon-deg.png') }}" height="50" width="50"
            class="" style="margin-top: -4px" alt="{{ $data->name }}"
            title="{{ $data->name }}">
        @endif
    </div>

    <div class="media-body">
            <h6 style="color: #544E67; font-size: 10px"> <b>{{ $data->name }}</b></h6>
    </div>
</a>
@endif
