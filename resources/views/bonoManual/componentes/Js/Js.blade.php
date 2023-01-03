<script>
let monto_a_utilizar = 0;

function monto(e){
    monto_a_utilizar = e;
}

function argegar_saldo(e){
  let codeBtn = document.getElementById('agregarBtn'+e);
  codeBtn.disabled = true;
  let seconds = 3;
  
  function segundos(){
                codeBtn.textContent =`Wait ${seconds}s`;
                seconds--;
                if( seconds > 0 ){
                    // console.log(seconds)
                    setTimeout(segundos,1000);
                }else{
                    codeBtn.disabled = false;
                    codeBtn.textContent = 'Next';
                }
            }
            
    segundos();

    axios.post('{{route("agregar_saldo")}}', {
       user_id :document.getElementById(`user_id${e}`).value,
       descripcion :document.getElementById(`descripcion${e}`).value,
       monto_a_agregar :  monto_a_utilizar,
  })
  .then(function (response) {
    let msj = response.data.msj;
    let ico = response.data.ico;
    backend_notificacion(msj,ico)

    monto_a_utilizar = 0
  })
  .catch(function (error) {
    console.log(error);
  });
}


function sustraer_saldo(e){
  let codeBtnSustraer = document.getElementById('sustraerBtn'+e);
  codeBtnSustraer.disabled = true;
  let seconds = 3;
  
  function segundos(){
                codeBtnSustraer.textContent =`Wait ${seconds}s`;
                seconds--;
                if( seconds > 0 ){
                    // console.log(seconds)
                    setTimeout(segundos,1000);
                }else{
                    codeBtnSustraer.disabled = false;
                    codeBtnSustraer.textContent = 'Next';
                }
            }
            
    segundos();

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
