<script>
    function pay(packageID,HASH){
        let montoSys = document.getElementById('montoSystem'+packageID).value;
        let ID =  document.getElementById('id'+packageID).value;
        
        axios.post('{{route("shop.transactionCompra")}}', {
        montoSystem: montoSys,
        id : ID,
    })
    .then(function (response) {
        notification(response.data.value);
        setTimeout( reload,1500);
    })
    .catch(function (error) {
        console.log(error);
    });
}
function payCrypto(packageID,HASH){
        let ID =  document.getElementById('id'+packageID).value;
        let Hash = document.getElementById('hash'+packageID).value;
        
        axios.post('{{route("shop.transactionCompraCrypto")}}', {
        id : ID,
        hash:Hash,
    })
    .then(function (response) {
        notification(response.data.value);
        //setTimeout( reload,1500);
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