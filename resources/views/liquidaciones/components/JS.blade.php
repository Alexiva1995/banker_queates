
<script>

    let cardValidar = document.getElementById('validado');
    let tablaPendientes = document.getElementById('liaquidaciones');

    function validar(){
        setTimeout(validado, 500);
    }

    function validado(){
        cardValidar.hidden = true;
        $('.ocultar').removeAttr("hidden");
    }

   async function recargarTabla(){

        $("#tabla").load(" #myTable");
        console.log('tabla destruida');
        const result = await resolveAfter2Seconds();


        $('#myTable').DataTable({
            order: [0, 'desc']
        }).draw();
        console.log('tabla iniciada');
    }
    function resolveAfter2Seconds(){
        return new Promise(resolve => {
        setTimeout(() => {
        resolve(
            $('.ocultar').removeAttr("hidden"),
            console.log('incializando tabla'),
        );
        }, 5000);
    });
    }

    
</script>
