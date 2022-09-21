@extends('layouts/contentLayoutMaster')
<style type="text/css">
html {
   box-sizing: border-box;
  font-size: 62.5%;
}

*,
*:before,
*:after {
  box-sizing: inherit;
}

body {
  font-family: 'Raleway', sans-serif;
  font-size: 1.6rem;
}


h1 {
  font-size: 4rem;
}

.contenedor {
  max-width: 1200px;
  width: 95%;
  margin: 0 auto;
}

.entrada-blog a {
  display: inline-block;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  font-weight: bold;
  text-transform: uppercase;
}


@media (min-width: 768px) {
  .dos-columnas{
    display: grid;
    grid-template-columns:50% 50%;
    grid-template-columns: repeat(2, 48.9%);
    column-gap: 2rem ;
  }
  .tres-columnas {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    column-gap: 2rem;
  }
}
.entrada-bloc a {
  display: inline-block;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
  font-weight: bold;
  text-transform: uppercase;
}

</style>
@section('content')
  <div class="MyEXCELSIOR d-flex bd-highlight rosado mb-3">
    <div class="p-2 flex-grow-1 bd-highlight">Finanzas<br>Mis ingresos</div>
    {{--<div class="bd-highlight btn Referral-text">Referral Link: <span>{{route('register')}}?referred_id={{Auth::id()}}</span></div>
    <div class="p-2 bd-highlight"><button class="btn rosado Referral-btn" onclick="getlink()">Copiar</button></div>--}}
  </div>
  <div class="container-fluid tres-columnas ">
    <div class="entrada-bloc">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold">BONO INICIO DIRECTO</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <i class="fas fa-user-check" style="font-size: 1.714rem;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->bonoInicio() != null)
          <div class="paragraph fw-bold h4 ">
            U${{(Auth::user()->bonoInicio())}}
          </div>
        @else
          <div class="paragraph fw-bold h4 ">
            U$0
          </div>
        @endif
      </div>
    </div>
    <div class="entrada-bloc">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold ">BONO RECOMPRA</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <i class="fas fa-user-check" style="font-size: 1.714rem;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->bonoRecompra() != null)
          <div class="paragraph fw-bold h4 ">
           U${{(Auth::user()->bonoRecompra())}}
          </div>
        @else
          <div class="paragraph fw-bold h4 ">
            U$0
          </div>
        @endif
      </div>
    </div>
    <div class="entrada-bloc">
      <div class="card p-2 cartas">
       {{--<div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold ">BONO BUILDING REWARD</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <i class="fas fa-user-check" style="font-size: 1.714rem;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->bonoIndirecto() != null)
          <div class="paragraph fw-bold h4 ">
            U${{(Auth::user()->bonoIndirecto())}}
          </div>
        @else
          <div class="paragraph fw-bold h4 ">
            U$0
          </div>
        @endif--}}
      </div>
    </div>
  </div>
  <div class="container-fluid dos-columnas">
    <div class="entrada-blog">
      <!-- BONO INICIO RÁPIDO INDIRECTO  -->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold">RENTABILIDAD</div>
          <div class="flex-shrink-0 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              {{--<div class="avatar-content">
                <i data-feather='list' style="font-size: 1.714rem;"></i>
              </div>--}}
            </div>
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <a type="button" data-bs-toggle="modal" data-bs-target="#ModalRendimientos">
                    <i data-feather='list' style="font-size: 1.714rem;"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->rendimiento() != null)
          <div class="paragraph fw-bold h4">
            U$ {{Auth::user()->rendimiento()}}
          </div>
        @else
          <div class="paragraph fw-bold h4">
            U$ 0
          </div>
        @endif
      </div>
    </div>
      <div class="entrada-blog">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold ">COMISIONES DISPONIBLES</div>
          <div class="flex-shrink-0 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              {{--<div class="avatar-content">
                <i data-feather='trending-up' style="font-size: 1.714rem;"></i>
              </div>--}}
            </div>
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <a type="button" data-bs-toggle="modal"data-bs-target="#ModalComisiones">
                    <i data-feather='list' style="font-size: 1.714rem;"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->totalIngresos() != null)
          <div class="paragraph fw-bold h4">
            U$ {{Auth::user()->totalIngresos() }}
          </div>
        @else
          <div class="paragraph fw-bold h4">
            U$ 0
          </div>
        @endif
      </div>
    </div>
    <div class="entrada-blog">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold ">TOTAL EN COMISIONES</div>
          <div class="flex-shrink-0 bd-highlight ">
            <div class="avatar bg-light-primary avatar-lg me-1">
              {{--<div class="avatar-content">
                <i data-feather='credit-card' style="font-size: 1.714rem;"></i>
              </div>--}}
            </div>
            <div class="avatar bg-light-primary avatar-lg me-1">
              <div class="avatar-content">
                <a type="button" data-bs-toggle="modal"data-bs-target="#ModalComisiones">
                    <i data-feather='list' style="font-size: 1.714rem;"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->disponible() != null)
          <div class="paragraph fw-bold h4">
            U$ {{Auth::user()->disponible()}}
          </div>
        @else
          <div class="paragraph fw-bold h4">
            U$ 0
          </div>
        @endif
      </div>
    </div>
  @include('financial.components.comisiones')
  @include('financial.components.rentabilidad')
  @include('financial.components.TotalComisiones')
@endsection
