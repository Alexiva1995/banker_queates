<body class="vertical-layout vertical-menu-modern {{ $configData['verticalMenuNavbarType'] }} {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }} {{ $configData['sidebarClass']}} {{ $configData['footerType'] }} {{$configData['contentLayout']}}" data-open="click" data-menu="vertical-menu-modern" data-col="{{$configData['showMenu'] ? $configData['contentLayout'] : '1-column' }}" data-framework="laravel" data-asset-path="{{ asset('/')}}">
  <!-- BEGIN: Header-->
  @include('panels.navbar')
  <!-- END: Header-->
<style>
body{
    font-family: 'Roboto', sans-serif;
  }
</style>
  <!-- BEGIN: Main Menu-->
  @if((isset($configData['showMenu']) && $configData['showMenu'] === true))
  @include('panels.sidebar')
  @endif
  <!-- END: Main Menu-->

  <!-- BEGIN: Content-->
  <div class="app-content content {{ $configData['pageClass'] }}">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class=""></div>

    @if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
    <div class="content-area-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
      <div class="{{ $configData['sidebarPositionClass'] }}">
        <div class="sidebar">
          {{-- Include Sidebar Content --}}
          @yield('content-sidebar')
        </div>
      </div>
      <div class="{{ $configData['contentsidebarClass'] }}">
        <div class="content-wrapper">
          <div class="content-body">
            {{-- Include Page Content --}}
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">
      {{-- Include Breadcrumb --}}
      @if($configData['pageHeader'] === true && isset($configData['pageHeader']))
      @include('panels.breadcrumb')
      @endif

      <div class="content-body">
        {{-- Include Page Content --}}
        @yield('content')
      </div>
    </div>
    @endif

  </div>
  <!-- End: Content-->

  @if($configData['blankPage'] == false && isset($configData['blankPage']))
  <!-- BEGIN: Customizer-->
  @include('content/pages/customizer')
  <!-- End: Customizer-->
  <!-- Buynow Button-->
  @include('content/pages/buy-now')
  @endif

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('panels/footer')

  {{-- include default scripts --}}
  @include('panels/scripts')

  <script type="text/javascript">
    $(window).on('load', function() {
      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    })

    @if(session('success'))

    toastr['success']('{{ session("success") }}', '¡Exitoso!', {
        closeButton: true,
        tapToDismiss: false
      });
    @endif

    @if(session('error'))
    toastr['error']('{{ session("error") }}', 'Error', {
        closeButton: true,
        tapToDismiss: false
      });
    @endif

    @if(session('warning'))
    toastr['warning']('{{ session("warning") }}', 'Advertenecia', {
        closeButton: true,
        tapToDismiss: false
      });
    @endif

    @if(session('info'))
    toastr['info']('{{ session("info") }}', 'Informacion', {
        closeButton: true,
        tapToDismiss: false
      });
    @endif

    @if(isset($errors))
    @foreach($errors -> all() as $message)
    toastr['error']('{{ $message }}', 'Validación fallida', {
      closeButton: true,
      tapToDismiss: false
    });
    @endforeach
    @endif
  </script>

  <script type="text/javascript">
   /*  var getStatusInterval = setInterval(function () {getStatus('info')}, 5000);
    $( document ).ready(function() {
      getStatus();
    }); */

    function googleTranslateElementInit() {

      new google.translate.TranslateElement({
        pageLanguage: jQuery('.goog-te-combo').val(),
        layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT
      }, 'google_translate_element');
    }
    jQuery('.lang-select').click(function(e) {
      var theLang = jQuery(this).attr('data-language');

      jQuery('.goog-te-combo').val(theLang);
      //alert(jQuery(this).attr('href'));

      fetch("{{url('lang')}}/" + theLang)
        .then(response => response.json())
        .then(data => {
          window.location = jQuery(this).attr('href');
          location.reload();
        })
        .catch(function(error) {
          console.log('Hubo un problema con la petición Fetch:' + error.message);
        });
    });
  </script>
</body>

</html>
