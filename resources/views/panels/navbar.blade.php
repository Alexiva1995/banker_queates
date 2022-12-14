@if($configData["mainLayoutType"] === 'horizontal' && isset($configData["mainLayoutType"]))
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-brand-center {{ $configData['navbarColor'] }}" data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="{{url('/')}}">
          <span class="brand-logo">
            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
              <defs>
                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                  <stop stop-color="#000000" offset="0%"></stop>
                  <stop stop-color="#FFFFFF" offset="100%"></stop>
                </lineargradient>
                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                  <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                  <stop stop-color="#FFFFFF" offset="100%"></stop>
                </lineargradient>
              </defs>
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                  <g id="Group" transform="translate(400.000000, 178.000000)">
                    <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                    <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                    <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                    <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                    <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                  </g>
                </g>
              </g>
            </svg></span>
          <h2 class="brand-text mb-0">Vuexy</h2>
        </a>
      </li>
    </ul>
  </div>
  @else
  <nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light  {{ $configData['navbarColor'] }} {{ ($configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType']  === 'navbar-floating') ? 'container-xxl' : '' }}">
    @endif
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
        <!-- <ul class="nav navbar-nav bookmark-icons">
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('app/email')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('app/chat')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('app/calendar')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('app/todo')}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link bookmark-star">
              <i class="ficon text-warning" data-feather="star"></i>
            </a>
            <div class="bookmark-input search-input">
              <div class="bookmark-input-icon">
                <i data-feather="search"></i>
              </div>
              <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
              <ul class="search-list search-list-bookmark"></ul>
            </div>
          </li>
        </ul> -->
        
      </div>
      <ul class="nav navbar-nav align-items-center ms-auto " >
      {{-- <li class="nav-item dropdown dropdown-language " >
          <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
            <i class="flag-icon flag-icon-mx"></i>
            <span class="selected-language ">ESPA??OL</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end  cartas" aria-labelledby="dropdown-flag" style="background: white">
            <a href="#googtrans(es|es)" class="dropdown-item lang-select" data-language="es" alt="ESPA??OL">
              <i class="flag-icon flag-icon-mx "></i> ESPA??OL
            </a>
            <a href="#googtrans(es|en)" class="dropdown-item lang-select" data-language="en" alt="INGLES">
              <i class="flag-icon flag-icon-us "></i> INGLES
            </a>
            <a href="#googtrans(es|fr)" class="dropdown-item lang-select" data-language="fr" alt="FRANC??S">
              <i class="flag-icon flag-icon-fr "></i> FRANC??S
            </a>
            <a href="#googtrans(es|de)" class="dropdown-item lang-select" data-language="de" alt="ALEM??N">
              <i class="flag-icon flag-icon-de "></i> ALEM??N
            </a>
            <a href="#googtrans(es|pt)" class="dropdown-item lang-select" data-language="pt" alt="PORTUGU??S">
              <i class="flag-icon flag-icon-pt "></i> PORTUGU??S
            </a>
          </div>
        </li>
         {{--  @if(Auth::user()->id !== 1)
       <li>
          @if(Auth::user()->date_activo <= date('Y-m-d')) <button class="btn Referral-btn rosado col-sm" data-bs-toggle="modal" data-bs-target="#Modal_reactivacion" >Hacer activaci??n</button>
        </li>
        <li>
          @else
          <button class="btn Referral-btn rosado" >Activo</button>
          @endif
        </li>
        @endif
      --}}

        <!-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
          <div class="search-input">
            <div class="search-input-icon"><i data-feather="search"></i></div>
            <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
            <div class="search-input-close"><i data-feather="x"></i></div>
            <ul class="search-list search-list-main"></ul>
          </div>
        </li>
        <li class="nav-item dropdown dropdown-cart me-25">
          <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="ficon" data-feather="shopping-cart"></i>
            <span class="badge rounded-pill bg-primary badge-up cart-item-count">6</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class="notification-title mb-0 me-auto">My Cart</h4>
                <div class="badge rounded-pill badge-light-primary">4 Items</div>
              </div>
            </li>
            <li class="scrollable-container media-list">
              <div class="list-item align-items-center">
                <img class="d-block rounded me-1" src="{{asset('images/pages/eCommerce/1.png')}}" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                  <i class="ficon cart-item-remove" data-feather="x"></i>
                  <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="{{url('app/ecommerce/details')}}"> Apple watch 5</a></h6><small class="cart-item-by">By Apple</small>
                  </div>
                  <div class="cart-item-qty">
                    <div class="input-group">
                      <input class="touchspin-cart" type="number" value="1">
                    </div>
                  </div>
                  <h5 class="cart-item-price">$374.90</h5>
                </div>
              </div>
              <div class="list-item align-items-center">
                <img class="d-block rounded me-1" src="{{asset('images/pages/eCommerce/7.png')}}" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                  <i class="ficon cart-item-remove" data-feather="x"></i>
                  <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="{{url('app/ecommerce/details')}}"> Google Home Mini</a></h6><small class="cart-item-by">By Google</small>
                  </div>
                  <div class="cart-item-qty">
                    <div class="input-group">
                      <input class="touchspin-cart" type="number" value="3">
                    </div>
                  </div>
                  <h5 class="cart-item-price">$129.40</h5>
                </div>
              </div>
              <div class="list-item align-items-center">
                <img class="d-block rounded me-1" src="{{asset('images/pages/eCommerce/2.png')}}" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                  <i class="ficon cart-item-remove" data-feather="x"></i>
                  <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="{{url('app/ecommerce/details')}}"> iPhone 11 Pro</a></h6><small class="cart-item-by">By Apple</small>
                  </div>
                  <div class="cart-item-qty">
                    <div class="input-group">
                      <input class="touchspin-cart" type="number" value="2">
                    </div>
                  </div>
                  <h5 class="cart-item-price">$699.00</h5>
                </div>
              </div>
              <div class="list-item align-items-center">
                <img class="d-block rounded me-1" src="{{asset('images/pages/eCommerce/3.png')}}" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                  <i class="ficon cart-item-remove" data-feather="x"></i>
                  <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="{{url('app/ecommerce/details')}}"> iMac Pro</a></h6><small class="cart-item-by">By Apple</small>
                  </div>
                  <div class="cart-item-qty">
                    <div class="input-group">
                      <input class="touchspin-cart" type="number" value="1">
                    </div>
                  </div>
                  <h5 class="cart-item-price">$4,999.00</h5>
                </div>
              </div>
              <div class="list-item align-items-center">
                <img class="d-block rounded me-1" src="{{asset('images/pages/eCommerce/5.png')}}" alt="donuts" width="62">
                <div class="list-item-body flex-grow-1">
                  <i class="ficon cart-item-remove" data-feather="x"></i>
                  <div class="media-heading">
                    <h6 class="cart-item-title"><a class="text-body" href="{{url('app/ecommerce/details')}}"> MacBook Pro</a></h6><small class="cart-item-by">By Apple</small>
                  </div>
                  <div class="cart-item-qty">
                    <div class="input-group">
                      <input class="touchspin-cart" type="number" value="1">
                    </div>
                  </div>
                  <h5 class="cart-item-price">$2,999.00</h5>
                </div>
              </div>
            </li>
            <li class="dropdown-menu-footer">
              <div class="d-flex justify-content-between mb-1">
                <h6 class="fw-bolder mb-0">Total:</h6>
                <h6 class="text-primary fw-bolder mb-0">$10,999.00</h6>
              </div>
              <a class="btn btn-primary w-100" href="{{url('app/ecommerce/checkout')}}">Checkout</a>
            </li>
          </ul>
        </li> -->
        <li class="nav-item d-lg-block me-1">
          <div class="form-check form-switch form-check-light">
            <input type="checkbox" class="form-check-input nav-link-style form-check-darkM" checked id="flexSwitchCheckDefault" >
            <label class="form-check-label" for="flexSwitchCheckDefault">
              <span class="switch-icon-right">
                <i class="ficonCustom" data-feather='moon'></i>
              </span>
              <span class="switch-icon-left">
                <i class="ficonCustom" data-feather='sun'></i>
              </span>
            </label>
          </div>
{{-- 
           <div class="d-flex align-content-around align-item-center">
             <i class="ficonCustom" data-feather='sun' style="margin-right: 0.3rem;"></i>

             <div class="form-check form-switch form-switch-sm mb-0">
              <input class="form-check-input nav-link-style" type="checkbox" id="flexSwitchCheckDefault">
            </div>

             <i class="ficonCustom" data-feather='moon' style="margin-left: -1.5rem;"></i>
           </div> --}}
        </li>
        <li class="nav-item dropdown dropdown-notification me-25 ">
          <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="ficon" data-feather="bell"></i>
            @if(count(auth()->user()->unreadNotifications) > 0)
                  <div class="badge rounded-pill badge-light-primary">{{count(auth()->user()->unreadNotifications)}}</div>
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end textoCustom">
            <li class="dropdown-menu-header">
              <div class="dropdown-header d-flex">
                <h4 class=" mb-0 me-auto textoCustom">Notificaciones</h4>
                @if(count(auth()->user()->unreadNotifications) > 0)
                  <div class="badge rounded-pill badge-light-primary">{{count(auth()->user()->unreadNotifications)}}</div>
                @endif
              </div>
            </li>
            <li class="scrollable-container media-list">
              @forelse(auth()->user()->unreadNotifications as $notificaciones)

                <a class="d-flex" href="javascript:void(0)">
                  <div class="list-item d-flex align-items-start">
                    {{--
                    <div class="me-1">
                      <div class="avatar">
                        @if(auth()->user()->photo == null)
                          <img src="{{asset('images/portrait/small/avatar-s-15.jpg')}}" alt="avatar" width="32" height="32">
                        @else
                          <img src="{{ asset('storage/photo-profile/'.$user->photo) }}" alt="avatar" width="32" height="32">
                        @endif
                      </div>
                    </div>
                    --}}
                    <div class="list-item-body flex-grow-1">
                      <p class="textoCustom"> {{$notificaciones->data['message']}}.</p>
                    </div>
                  </div>
                </a>
              @empty
              <p class="textoCustom m-1"> Sin notificaciones.</p>
              @endforelse

            </li>
            @if(count(auth()->user()->unreadNotifications) > 0)
              <li class="dropdown-menu-footer">
                <form action="{{route('user.notificacionesLeidas')}}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-primary w-100">Marcar todas como leidas</button>
                </form>

              </li>
            @endif
          </ul>
        </li>
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
            <div class="user-nav d-sm-flex d-none">
              <span class="user-name fw-bolder text-capitalize" >{{Auth::user()->name}}</span>
              {{-- <span class="user-name fw-bolder text-capitalize" >{{Auth::user()->last_name}}</span> --}}

            </div>
            @if( auth()->user()->investment !== null && auth()->user()->admin == 0 )
              <img class="round" src="" alt="{{'emblema'.auth()->user()->investment->licensePackage->emblem}}" height="40" width="40">
            @endif
            <span class="avatar">
              @if(Auth::user()->photo == null)
                <img class="round" src="{{asset('images/portrait/small/avatar-s-11.jpg')}}" alt="avatar" height="40" width="40">
              @else
                <img class="round" src="{{ asset('storage/photo-profile/'.Auth::user()->photo) }}" alt="avatar" height="40" width="40">
              @endif
             {{-- @if(Auth::user()->status == 1)
                 <span class="avatar-status-online"></span>
              @else
                <span class="avatar-status-offline"></span>
              @endif --}}
            </span>
          </a>
          <div class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdown-user" >
            @if(Auth::user()->admin == 1 || Auth::user()->status == 1 || Auth::user()->admin == 2)
              <a class="dropdown-item text-light" href="{{url('profile')}}">
                <i class="me-1 text-primary" data-feather="user" ></i> Mi Perfil
              </a>
            @else
            <a class="dropdown-item text-light" href="#">
              <i class="me-1 text-primary" data-feather="user"></i> Mi Perfil
            </a>
            @endif
           
            <!-- <a class="dropdown-item" href="{{url('app/email')}}">
              <i class="me-50" data-feather="mail"></i> Inbox
            </a>
            <a class="dropdown-item" href="{{url('app/todo')}}">
              <i class="me-50" data-feather="check-square"></i> Task
            </a>
            <a class="dropdown-item" href="{{url('app/chat')}}">
              <i class="me-50" data-feather="message-square"></i> Chats
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('page/account-settings')}}">
              <i class="me-50" data-feather="settings"></i> Settings
            </a>
            <a class="dropdown-item" href="{{url('page/pricing')}}">
              <i class="me-50" data-feather="credit-card"></i> Pricing
            </a>
            <a class="dropdown-item" href="{{url('page/faq')}}">
              <i class="me-50" data-feather="help-circle"></i> FAQ
            </a> -->

            @if (session('impersonated_by'))
            <a class="dropdown-item text-light" href="{{ route('impersonate.stop') }}">
              <i data-feather='home' class="text-primary"></i> Volver al admin
            </a>
            @endif
            <form method="POST" class="mb-0" action="{{ route('logout') }}">
              @csrf
              <button class="dropdown-item w-100 text-light" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                <i class="me-1 text-primary" data-feather="log-out" ></i> Cerrar sesion
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  {{-- Search Start Here --}}
  <ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center">
      <a href="javascript:void(0);">
        <h6 class="section-label mt-75 mb-0">Files</h6>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between w-100" href="{{url('app/file-manager')}}">
        <div class="d-flex">
          <div class="me-75">
            <img src="{{asset('images/icons/xls.png')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">Two new item submitted</p>
            <small class="text-muted">Marketing Manager</small>
          </div>
        </div>
        <small class="search-data-size me-50 text-muted">&apos;17kb</small>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between w-100" href="{{url('app/file-manager')}}">
        <div class="d-flex">
          <div class="me-75">
            <img src="{{asset('images/icons/jpg.png')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">52 JPG file Generated</p>
            <small class="text-muted">FontEnd Developer</small>
          </div>
        </div>
        <small class="search-data-size me-50 text-muted">&apos;11kb</small>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between w-100" href="{{url('app/file-manager')}}">
        <div class="d-flex">
          <div class="me-75">
            <img src="{{asset('images/icons/pdf.png')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">25 PDF File Uploaded</p>
            <small class="text-muted">Digital Marketing Manager</small>
          </div>
        </div>
        <small class="search-data-size me-50 text-muted">&apos;150kb</small>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between w-100" href="{{url('app/file-manager')}}">
        <div class="d-flex">
          <div class="me-75">
            <img src="{{asset('images/icons/doc.png')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">Anna_Strong.doc</p>
            <small class="text-muted">Web Designer</small>
          </div>
        </div>
        <small class="search-data-size me-50 text-muted">&apos;256kb</small>
      </a>
    </li>
    <li class="d-flex align-items-center">
      <a href="javascript:void(0);">
        <h6 class="section-label mt-75 mb-0">Members</h6>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{url('app/user/view')}}">
        <div class="d-flex align-items-center">
          <div class="avatar me-75">
            <img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">John Doe</p>
            <small class="text-muted">UI designer</small>
          </div>
        </div>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{url('app/user/view')}}">
        <div class="d-flex align-items-center">
          <div class="avatar me-75">
            <img src="{{asset('images/portrait/small/avatar-s-1.jpg')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">Michal Clark</p>
            <small class="text-muted">FontEnd Developer</small>
          </div>
        </div>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{url('app/user/view')}}">
        <div class="d-flex align-items-center">
          <div class="avatar me-75">
            <img src="{{asset('images/portrait/small/avatar-s-14.jpg')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">Milena Gibson</p>
            <small class="text-muted">Digital Marketing Manager</small>
          </div>
        </div>
      </a>
    </li>
    <li class="auto-suggestion">
      <a class="d-flex align-items-center justify-content-between py-50 w-100" href="{{url('app/user/view')}}">
        <div class="d-flex align-items-center">
          <div class="avatar me-75">
            <img src="{{asset('images/portrait/small/avatar-s-6.jpg')}}" alt="png" height="32">
          </div>
          <div class="search-data">
            <p class="search-data-title mb-0">Anna Strong</p>
            <small class="text-muted">Web Designer</small>
          </div>
        </div>
      </a>
    </li>
  </ul>

  {{-- if main search not found! --}}
  <ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between">
      <a class="d-flex align-items-center justify-content-between w-100 py-50">
        <div class="d-flex justify-content-start">
          <span class="me-75" data-feather="alert-circle"></span>
          <span>No results found.</span>
        </div>
      </a>
    </li>
  </ul>
  @include('panels/Reactivacion')
  {{-- Search Ends --}}
  <!-- END: Header-->
