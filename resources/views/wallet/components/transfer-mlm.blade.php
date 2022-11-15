<!-- Modal -->
<div class="modal fade" id="transferMlm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Transferir saldo MLM</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('transfer.mlm')}}" method="POST">
            @csrf
            <div class="modal-body">
            <label for="amount">Monto</label>
            <input class="form-control" type="hidden" name="amount" value="{{$comissionsAvailable}}">
            <input class="form-control" type="text" name="amount" value="{{$comissionsAvailable}}" disabled>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Transferir</button>
            </div>
        </form>
      </div>
    </div>
  </div>
