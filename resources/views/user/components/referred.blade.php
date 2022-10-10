

<!-- Modal -->
<div class="modal fade" id="referred{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Referido de {{$user->name}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{route('referred.update')}}" method="POST">
        @csrf
        <input type="hidden" name="user" value="{{$user->id}}">
        <div class="modal-body">
          <label for="referido">Referido Actual</label>
          <input type="number" class="form-control mb-2" name="referido" value="{{$user->referred_id}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>