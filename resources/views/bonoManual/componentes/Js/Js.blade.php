<script>
let monto_agregar_saldo = 0;

function monto(e){
    monto_agregar_saldo = e;
}

function argegar_saldo(e){
    axios.post('{{route("agregar_saldo")}}', {
       user_id :document.getElementById(`user_id${e}`).value,
       monto_a_agregar :  monto_agregar_saldo,
  })
  .then(function (response) {
    let respuesta = response.data.value;
    backen_notificacion(respuesta)
    $( `#agregar-saldo${e}` ).load( ` #agregar-saldo${e}`);
    monto_agregar_saldo = 0
  })
  .catch(function (error) {
    console.log(error);
  });
}

function backen_notificacion(e){
    if(e == 'succes'){
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Saldo agregado correctamente',
        showConfirmButton: false,
        timer: 1500
})
    }else{
        Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'Monto invalido',
        showConfirmButton: false,
        timer: 1500
        })   
    }
}

</script>
