<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal{{$user->id}}">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="agregar-saldo-tab" data-bs-toggle="tab" data-bs-target="#agregar-saldo{{$user->id}}" type="button" role="tab" aria-controls="agregar-saldo" aria-selected="true">Agregar saldo</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="sustraer-saldo-tab" data-bs-toggle="tab" data-bs-target="#sustraer-saldo{{$user->id}}" type="button" role="tab" aria-controls="sustraer-saldo" aria-selected="false">Sustraer saldo</button>
                </li>

              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="agregar-saldo{{$user->id}}" role="tabpanel" aria-labelledby="agregar-saldo-tab">
                    <form>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col">
                                    <label for="disabledTextInput" class="form-label">Usuario :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->name}}" disabled>
                                </div>
                                {{--<div class="col">
                                    <label for="disabledTextInput" class="form-label">Saldo :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->saldo_disponible}}$" disabled>
                                </div>--}}
                              </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="mb-1">
                              <label   class="form-label">Agregar saldo</label>
                              <input id="monto-agregar-saldo" onkeyup="monto(this.value)" type="number" class="form-control" >
                              <input type="hidden" id="user_id{{$user->id}}" value="{{$user->id}}">
                            </div>
                          </div>

                          <div class="col-6">
                            <div class="mb-1">
                              <label   class="form-label">Descripcion</label>
                              <input  type="text" class="form-control" id="descripcion{{$user->id}}">
                            </div>
                          </div>

                      </div>

                        <a onclick="argegar_saldo({{$user->id}})" class="btn btn-primary">Realizar</a>
                    </form>
                </div>

                <div class="tab-pane fade" id="sustraer-saldo{{$user->id}}" role="tabpanel" aria-labelledby="sustraer-saldo-tab">
                    <form id="sustraer{{$user->id}}">
                        <div class="mb-1">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="disabledTextInput" class="form-label">Usuario :</label>
                                        <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                   {{-- <div class="mb-1">
                                        <label for="disabledTextInput" class="form-label">Saldo :</label>
                                        <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->saldo_disponible}}$" disabled>
                                    </div>--}}
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label for="exampleInputPassword1" class="form-label">Sustraer saldo</label>
                                        <input id="sustraer-saldo" onkeyup="monto(this.value)" type="number" class="form-control">
                                        <input type="hidden" id="user_id{{$user->id}}" value="{{$user->id}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-1">
                                      <label   class="form-label">Descripcion</label>
                                      <input  type="text" class="form-control" id="description{{$user->id}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <a onclick="sustraer_saldo({{$user->id}})" class="btn btn-primary">Realizar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
