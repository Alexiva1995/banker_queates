<script>
    function pay(packageID){
        let montoSys = document.getElementById('montoSystem'+packageID);
        
        let montoCrypt = document.getElementById('montoCrypto'+packageID);
        
        if(montoSys.disabled == true){
            montoSys = [];
        }else{
            montoSys = montoSys.value; 
        }

        if(montoCrypt.disabled == true){
            montoCrypt = [];
        }else{
            montoCrypt = montoCrypt.value;
        }

        axios.post('{{route("shop.transactionCompra")}}', {
        montoSystem: montoSys,
        montoCrypto: montoCrypt,
        id : document.getElementById('id'+packageID).value
    })
    .then(function (response) {
        notification(response.data.value);

        setTimeout( reload,2000);
    })
    .catch(function (error) {
        console.log(error);
    });
}

function tipo(tipo,packageID){
    let montoSystem = document.getElementById('montoSystem'+packageID);
    let montoCrypto = document.getElementById('montoCrypto'+packageID);

    console.log(tipo);

    if(tipo === 'cripto'){
        montoSystem.disabled = true ;
        montoCrypto.disabled = false;
    }else{
        montoSystem.disabled = false;
        montoCrypto.disabled = true;
    }

}

function notification(e){
    Swal.fire({
    position: 'top-end',
    icon: e.status,
    title: e.msj,
    showConfirmButton: false,
    timer: 1500
    })
}

function reload(){
    window.location.reload();
}

</script>