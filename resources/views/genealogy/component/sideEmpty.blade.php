{{--@if (strtolower($type) == 'matriz')
    @if ($cant < 2)
        <li class="va">
            <!--<a href="javascript:;" class="rounded-circles"><img src="{{asset('img/logo/blackbox.png')}}" class="rounded-circles"  alt="add"></a>-->
        </li>
    @endif
@endif--}}

@if ($cant < 2)
    <li class="va">
        <a>
            <div class="media d-flex justify-content-center ">
                <img src="{{ asset('images/avatars-profile/1.png') }}" height="70" width="64"
                class="rounded-circle" style="margin-top: -4px"> 
            </div>
        </a>
    </li>
@endif