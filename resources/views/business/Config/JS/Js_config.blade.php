<script>
function Guardar_configuracion(){
    axios.post('{{route("guardar.configuracion")}}', {
        desde: document.getElementById('dia_desde').value,
        hasta: document.getElementById('dia_hasta').value,
        hora_inicial: document.getElementById('hora_inicial').value,
        hora_final: document.getElementById('hora_final').value,
        fee_valor: document.getElementById('fee_valor').value,
        transferencias_entre_users: document.getElementById('transferencias_entre_users').value,
    })
    .then(function (response) {
        if(response.data.value == 1){
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Configuracion de retiro actualizada',
            showConfirmButton: false,
            timer: 1500
            })
            $("#config").load(" #config");
        }
        if(response.data.value == 2){
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Selecciones los dias de retiro',
            showConfirmButton: false,
            timer: 1500
            })
            $("#config").load(" #config");
        }
    })
    .catch(function (error) {
            console.log(error);
    });
}
</script>
