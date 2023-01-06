<!-- Modal -->
<div class="modal fade" id="rankModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Range Edition</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-sm-6">
              <form action="{{ route('user.assign.range',$user->id) }}" method="POST" >
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Current range</label>
                  @if ($user->range_id != null)
                  <input type="number" class="form-control" value="{{$user->range_id}}" disabled>
                  @else
                  <input type="text" class="form-control" value="no rank" disabled>
                  @endif
                </div>
                <div class="mb-3">
                  <select name="newRank" class="form-select" aria-label="Default select example">
                    <option selected>{{$user->range_id}}</option>
                    <option value="1" name="1">1</option>
                    <option value="2" name="2">2</option>
                    <option value="3" name="3">3</option>
                    <option value="4" name="4">4</option>
                    <option value="5" name="5">5</option>
                    <option value="6" name="6">6</option>
                  </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>

            <div class="col-sm-6">
              <div class="square-active d-flex justify-content-center align-items-center">
                @if ($user->range_id != null)
                <img src="{{ asset('images/ensignRanges/'.$user->range_id .'.png') }}" height="130" width="170">
                @endif
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>