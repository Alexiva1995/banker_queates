@php
$configData = Helper::applClasses();
@endphp
<style>
   
</style>
<div class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion "
    data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav">
            <li class="nav-item d-flex justify-content-center">
                <a class="navbar-brand" href="{{ url('/panels') }}">

                    <img class="site-logo-light" src="{{ asset('images/logo/logo-deg.png')}}"  width="164">

                    <img class="site-logo-dark" src="{{ asset('images/logo/logo-white.png')}}"  width="164">

                </a>
            </li>
            <!-- <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" class="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" class="disc" data-ticon="disc"></i>
        </a>
      </li> -->
        </ul>
    </div>
    <br>
    <hr>
    <br>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Para Usuarios Normales --}}
            @if (Auth::user()->admin == 0)
                {{-- Foreach menu item starts --}}
                @if (isset($menuData[0]))
                    @foreach ($menuData[0]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('locale.' . $menu->navheader) }}</span>
                                <i class="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="mb-25 nav-item shadow-none {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                @if (Auth::user()->status == '1')
                                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                        class="d-flex align-items-center shadow-none"
                                        target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                        <i class="{{ $menu->icon }}"></i>
                                        <span class="menu-title text-truncate">{{ __('locale.' . $menu->name) }}</span>
                                        @if (isset($menu->badge))
                                            <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                            <span
                                                class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                        @endif
                                    </a>
                                 @elseif(Auth::user()->status =='0')
                                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                    {{-- <a href="{{ Auth::user()->status == '1' ? ($menu->name == 'Unilevel' || $menu->name == 'Inicio' ? (isset($menu->url) ? url($menu->url) : 'javascript:void(0)') : '#') : '#' }}" --}}
                                        class="d-flex align-items-center shadow-none"
                                        target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                        <i class="{{ $menu->icon }}"></i>
                                        <span class="menu-title text-truncate">{{ __('locale.' . $menu->name) }}</span>
                                        @if (isset($menu->badge))
                                            <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                            <span
                                                class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                        @endif
                                    </a>
                                @endif 
                                @if (isset($menu->submenu))
                                    @include('panels/submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
                {{-- Foreach menu item ends --}}

                {{-- para usuarios admin --}}
            @else
                {{-- Foreach menu item starts --}}
                @if (Auth::user()->admin == 1)
                    @if (isset($menuData[1]))
                        @foreach ($menuData[1]->menu as $menu)
                            @if (isset($menu->navheader))
                                <li class="navigation-header">
                                    <span>{{ __('locale.' . $menu->navheader) }}</span>
                                    <i class="more-horizontal"></i>
                                </li>
                            @else
                                {{-- Add Custom Class with nav-item --}}
                                @php
                                    $custom_classes = '';
                                    if (isset($menu->classlist)) {
                                        $custom_classes = $menu->classlist;
                                    }
                                @endphp
                                <li
                                    class="nav-item shadow-none {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                        class="d-flex align-items-center shadow-none"
                                        target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                        <i class="{{ $menu->icon }}"></i>
                                        <span class="menu-title text-truncate">{{ __('locale.' . $menu->name) }}</span>
                                        @if (isset($menu->badge))
                                            <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                            <span
                                                class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                        @endif
                                    </a>
                                    @if (isset($menu->submenu))
                                        @include('panels/submenu', ['menu' => $menu->submenu])
                                    @endif
                                </li>
                            @endif
                        @endforeach

                        {{-- @if (env('APP_ENV') == 'local' && Auth::user()->admin == 1)

                            <div class="">
                                <button class="btn-grad m-2 dropdown-item w-100 dropbtn" onclick="myFunction()"
                                    class="">
                                    <i class="fas fa-sign text-white" style="font-size: 17px;"></i>
                                    <span class="text-white fw-bold" style="margin-left: 13px;">Crones</span>
                                </button>
                                <div id="myDropdown" class="dropdown-content">
                                    <a href="{{ route('bono.cartera') }}" class="text-white fw-bold">Cartera</a>
                                    <a href="{{ route('bono.cronRentabilidad') }}"
                                        class="text-white fw-bold">Rentabilidad</a>
                                    <a href="{{ route('start.cronSumRentabilidad') }}"
                                        class="text-white fw-bold">sumRentabilidad</a>
                                    <a href="{{ route('start.payrentabilidad') }}"
                                        class="text-white fw-bold">PagaRentabilidad</a>
                                </div>
                            </div>
                        @endif --}}


                    @endif
                    {{-- Foreach menu item ends --}}
                @endif
            @endif
            {{-- para usuarios subadmin --}}
            @if (Auth::user()->admin == 2)
                @if (isset($menuData[2]))
                    @foreach ($menuData[2]->menu as $menu)
                        @if (isset($menu->navheader))
                            <li class="navigation-header">
                                <span>{{ __('locale.' . $menu->navheader) }}</span>
                                <i class="more-horizontal"></i>
                            </li>
                        @else
                            {{-- Add Custom Class with nav-item --}}
                            @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                            @endphp
                            <li
                                class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
                                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                                    class="d-flex align-items-center"
                                    target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                    <i class="{{ $menu->icon }}"></i>
                                    <span class="menu-title text-truncate">{{ __('locale.' . $menu->name) }}</span>
                                    @if (isset($menu->badge))
                                        <?php $badgeClasses = 'badge badge-pill badge-light-primary ml-auto mr-1'; ?>
                                        <span
                                            class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{ $menu->badge }}</span>
                                    @endif
                                </a>
                                @if (isset($menu->submenu))
                                    @include('panels/submenu', ['menu' => $menu->submenu])
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif
            @endif
            {{-- end if subadmin --}}
            <!--    <li class="mt-1">

            </li>-->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="nav-item shadow-none" style="margin: 0 15px;">
                    <a class="d-flex align-items-center"
                        onclick="event.preventDefault();this.closest('form').submit();">
                        <i class='fa-solid fa-arrow-right-from-bracket' style="font-size: 23px; height: 24px;"></i> <span class="menu-title"
                            style="">Cerrar sesión</span>
                    </a>
                </li>
            </form>
        </ul>
    </div>
    <style>
    .main-menu.menu-light .navigation > li.active > a > i {
    
    color: #fff !important;
}
        .btn-grad:hover,
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #05A5E9;
        }

        .btn-grad {
            padding: 13px;
            transition: 0.5s;
            background-size: 200% auto;
            border-radius: 10px;
            display: block;
        }

        .btn-grad:hover {
            background-position: right center;
            color: #fff;
            text-decoration: none;
        }

        .btn-grad:hover>span {
            color: #fff;
        }

        .dropbtn {
            background-color: transparent;
            color: white;
            border-radius: 10px;
            font-size: 16px;
            margin-left: 50px;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            background-color: transparent;
            min-width: 160px;
            margin-left: 50px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            color: #808E9E;
            display: block;
        }

        .dropdown-content a:hover {
            background-image: linear-gradient(to right, #7367F01F 0%, #EBAAFF 51%, #7367F01F 100%)
        }

        .show {
            display: block;
        }
        i,a{
        color:  #03CDB6!important;
    }
    </style>
    <script>
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</div>
<!-- END: Main Menu-->
