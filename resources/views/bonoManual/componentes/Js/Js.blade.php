<script>
let monto_a_utilizar = 0;

function monto(e){
    monto_a_utilizar = e;
}

function argegar_saldo(e){
    axios.post('{{route("agregar_saldo")}}', {
       user_id :document.getElementById(`user_id${e}`).value,
       descripcion :document.getElementById(`descripcion${e}`).value,
       monto_a_agregar :  monto_a_utilizar,
  })
  .then(function (response) {
    let msj = response.data.msj;
    let ico = response.data.ico;
    backend_notificacion(msj,ico)
    refresh_div(e);

    monto_a_utilizar = 0
  })
  .catch(function (error) {
    console.log(error);
  });
}


function sustraer_saldo(e){
    axios.post('{{route("sustraer_saldo")}}', {
       user_id :document.getElementById(`user_id${e}`).value,
       description :document.getElementById(`description${e}`).value,
       monto_a_sustraer :  monto_a_utilizar,
  })
  .then(function (response) {
    let msj = response.data.msj;
    let ico = response.data.ico;

    backend_notificacion(msj,ico)
    refresh_div(e);

    monto_a_utilizar = 0
  })
  .catch(function (error) {
    console.log(error);
  });
}



function backend_notificacion(msj,ico){
  Swal.fire({
        position: 'top-end',
        icon: ico,
        title: msj,
        showConfirmButton: false,
        timer: 1500
})
}

function refresh_div(e){
  $(`#modal${e}` ).load(` #modal${e}`);
}
</script>
