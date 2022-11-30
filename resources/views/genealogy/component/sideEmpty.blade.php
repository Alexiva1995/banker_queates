{{--@if (strtolower($type) == 'matriz')
    @if ($cant < 2)
        <li class="va">
            <!--<a href="javascript:;" class="rounded-circles"><img src="{{asset('img/logo/blackbox.png')}}" class="rounded-circles"  alt="add"></a>-->
        </li>
    @endif
@endif--}}

@if ($cant < 2)
    <li>
        <a>
            <div class="media d-flex justify-content-center ">
                <img src="{{ asset('images/ensignRanges/sin-referido.png') }}" height="80" width="70"
                class="rounded-circle"  style="margin-top: -2px">
            </div>
        </a>
    </li>
@endif