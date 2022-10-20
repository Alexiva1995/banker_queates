<!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop{{$user->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home{{$user->id}}" type="button" role="tab" aria-controls="home" aria-selected="true">Agregar saldo</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile{{$user->id}}" type="button" role="tab" aria-controls="profile" aria-selected="false">Sustraer saldo</button>
                </li>
              
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home{{$user->id}}" role="tabpanel" aria-labelledby="home-tab">
                    <form>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col">
                                    <label for="disabledTextInput" class="form-label">Usuario :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->name}}" disabled>
                                </div>
                                <div class="col">
                                    <label for="disabledTextInput" class="form-label">Saldo :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->saldo_disponible}}$" disabled>
                                </div>
                              </div>
                        </div>
                        <div class="mb-1">
                          <label for="exampleInputPassword1" class="form-label">Agregar saldo</label>
                          <input type="number" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                
                <div class="tab-pane fade" id="profile{{$user->id}}" role="tabpanel" aria-labelledby="profile-tab">
                    <form>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col">
                                    <label for="disabledTextInput" class="form-label">Usuario :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->name}}" disabled>
                                </div>
                                <div class="col">
                                    <label for="disabledTextInput" class="form-label">Saldo :</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="{{$user->saldo_disponible}}$" disabled>
                                </div>
                              </div>
                        </div>
                        <div class="mb-1">
                          <label for="exampleInputPassword1" class="form-label">Sustraer saldo</label>
                          <input type="number" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
              </div>

        </div>
      </div>
    </div>
  </div>