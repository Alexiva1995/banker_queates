<div class="modal fade" id="Modalphoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content p-1">
            <div class="modal-header">
                <h4 class="modal-title fw-600" id="exampleModalCenterTitle">Foto de Perfil</h4>
                <button type="button" class="btn-close box-shadow-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <h6 class="p-1 fw-300">Carga manualmente un archivo</h6>
            <form action="{{route('photo.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-center my-1 box rounded-3 mx-25 py-1">
                    <div class="col-sm-5 capa-exterior rounded-3 align-items-center d-flex flex-column" style="width: 90%">
                        <i data-feather='upload-cloud' class="font-large-4 text-light mt-2"></i>
                        <label for="hiddenBtn" class="choose-btn capa-interior fw-400 mt-1" id="chooseBtn">
                            <span class="text-primary text-decoration-underline">explore</span> sus archivos
                        </label>
                        <input type="file" id="hiddenBtn" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" style="display: none;" accept="image/png,image/jpeg">
                        <br>

                        @error('image')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                        @enderror

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger px-75" data-dismiss="modal" arial-label="close" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>