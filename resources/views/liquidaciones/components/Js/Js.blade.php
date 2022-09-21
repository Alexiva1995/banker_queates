<script>
function regresar(id,accion){
    procesar(id,accion);


}

function animacion(id,accion){
    let tabla = document.getElementById(`tabla${id}`);
    tabla .style.opacity = '0';
    if(accion == 'aprobar'){
        tabla.style.backgroundColor = 'rgb(149, 255, 145)';
    }else{
        tabla.style.backgroundColor = 'rgb(253, 165, 165)';
    }
    setTimeout(function(){
        tabla.remove(tabla);
    }, 700);
}

function procesar(id,accion){
    axios.post('{{route("liquidacion.process")}}', {
        accion: accion,
        liquidacion_id: id,
        HASH_transaccion:document.getElementById(`HASH_transaccion`).value,
  })
  .then(function (response) {
    if(response.data.value == 'liquidacion_regresada'){
            Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Liquidacion regresada',
            showConfirmButton: false,
            timer: 1500
            })
            animacion(id,accion);
        }
        if(response.data.value == 'Liquidacion_aprobada'){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Liquidacion aprobada',
            showConfirmButton: false,
            timer: 1500
            })
            animacion(id,accion);
        }
        if(response.data.value == 'sin_hash'){
            Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'HASH requerido para aprobar liquidacion',
            showConfirmButton: false,
            timer: 1500
            })
        }
  })
  .catch(function (error) {
    console.log(error);
  });
}

function copyToClipBoard_regresar(id){
let copyInput = document.querySelector(`#wallet${id}`);
    copyInput.select();
    console.log(copyInput );
    document.execCommand('copy');
}
function copyToClipBoard_aprobar(id){
let copyInput = document.querySelector(`#wallet_aprobar${id}`);
    copyInput.select();
    console.log(copyInput );
    document.execCommand('copy');
}
</script>
