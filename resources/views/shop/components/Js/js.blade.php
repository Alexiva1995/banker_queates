<script>
    function pay(packageID){
        let sys = document.getElementById('montoSystem'+packageID).value
        axios.post('{{route("shop.transactionCompra")}}', {
        montoSystem: document.getElementById('montoSystem'+packageID).value,
        lastName: 'Flintstone'
    })
    .then(function (response) {
        console.log( sys);
    })
    .catch(function (error) {
        console.log(error);
    });
}
</script>