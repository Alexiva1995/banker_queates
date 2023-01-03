<script>
    function pay(packageID){
        axios.post('{{route("shop.transactionCompra")}}', {
        montoSystem: document.getElementById('montoSystem'+packageID).value,
        montoCrypto:document.getElementById('montoCrypto'+packageID).value
    })
    .then(function (response) {
        console.log( );
    })
    .catch(function (error) {
        console.log(error);
    });
}

function type(tipo,packageID){
    let montoSystem = document.getElementById('montoSystem'+packageID).value;
    let montoCrypto = document.getElementById('montoCrypto'+packageID).value;
console.log(tipo);
    if(tipo == 'cripto'){
        montoSystem.disabled = true ;
        montoCrypto.disabled = false;
    }else{
        montoSystem.disabled = false;
        montoCrypto.disabled = true;
    }
    
}
</script>