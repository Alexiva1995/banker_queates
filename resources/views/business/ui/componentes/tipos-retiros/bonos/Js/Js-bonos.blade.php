<script>
     let wallet_bonus = 0;
     let Monto_a_retirar_bonus = 0;
     let ButtonContinue_bonus = 0;

function pegar_bonos(e){
    let ButtonContinue_bonus= document.getElementById('continue-button_bonus');

    setTimeout(function(){
        if( e.value.length > 16 &&  Monto_a_retirar_bonus > 49 ){
            console.log(e.value.length);
            ButtonContinue_bonus.disabled = false;
        }else{
        (wallet_bonus.value);
        ButtonContinue_bonus.disabled = true;

        }
    }, 4);

}

function w_bonos(){
        let value = document.getElementById('wallet_bonus').value;
        let Value_Monto = document.getElementById('Monto_a_retirar_bono').value;
        let value_ButtonContinue = document.getElementById('continue-button_bonus');

        wallet_bonus = value;
        Monto_a_retirar_bonus = Value_Monto;
        ButtonContinue_bonus = value_ButtonContinue;
        percentage(Monto_a_retirar_bonus);
        if(wallet_bonus.length > 16 &&  Monto_a_retirar_bonus> 49 ){
            console.log(Monto_a_retirar_bonus);
            ButtonContinue_bonus.disabled = false;
        }else{
        (wallet_bonus.value);
        ButtonContinue_bonus.disabled = true;
            console.log(Monto_a_retirar_bonus);

        }
    }
    function activarInput_bonus(e){
    Monto_a_retirar_bonus = e;
    percentage(Monto_a_retirar_bonus);

    if( wallet_bonus.length > 16 &&  Monto_a_retirar_bonus > 49 ){
        ButtonContinue_bonus.disabled = false;
    }else{
        (wallet_bonus.value);
        ButtonContinue_bonus.disabled = true;
    }
}

function percentage(e){
    const fee = @json($fee);
    let total = document.getElementById('total');
    let avaibleBalanceTotal = document.getElementById('avaibleBalanceTotal').value;

    if(e > 49 ){
        let n = (e * fee )/100;

        total.innerHTML = `${e - n} USD`;
    }else{
        total.innerHTML ='--------';
    }
}

function verificarRetiro_bonus(){
    let title = document.getElementById('title_bonus');
    let body = document.getElementById('body_bonus');
    let footer = document.getElementById('footer_bonus');
    let passed = document.getElementById('passed_bonus');
    let contenedorspiner = document.getElementById('contenedorspiner_bonus');
    let spiner = document.getElementById('spiner_bonus');


    axios.post('{{route("verificar.user.retiro")}}', {
        code: document.getElementById('code_bonus').value,
        Monto_a_retirar: document.getElementById('Monto_a_retirar_bono').value,
        wallet: document.getElementById('wallet_bonus').value,
        type:'bonus',
    })
    .then(function (response) {
        if(response.data.value == 1){
            title.hidden = true;
            body.hidden = true;
            footer.hidden = true;
            spiner.hidden = false;
            contenedorspiner.hidden = false;

            setTimeout(function(){
                spiner.hidden = true;
                passed.hidden = false;
            },1500);

            setTimeout(reload,4000);
        }
        if(response.data.value == 0){
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Codigo incorrecto',
            showConfirmButton: false,
            timer: 1500
            })
        }
        if(response.data.value == 2){
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'El monto intruducido supera tu saldo disponible ',
            showConfirmButton: false,
            timer: 1500
            })
        }
    })
    .catch(function (error) {
            console.log(error);
    });


}

function maxBono(){
    const BonusRange = @json($BonusRange);
    let Monto_a_retirar_bono =  document.getElementById('Monto_a_retirar_bono');
    Monto_a_retirar_bono.value = BonusRange;
    w_bonos();
}

function getCode_bonus(){
    let codeButton = document.getElementById('codeButton_bonus');
    codeButton.disabled = true;
    let seconds = 30;
    function segundos(){
       codeButton.innerHTML ='Reenviar en '+' '+seconds;
       seconds--;
       if(seconds > 0 ){
        console.log(seconds)
        setTimeout(segundos,1000);
       }else{
        codeButton.disabled = false;
        codeButton.innerHTML = 'Obtener codigo';
       }
    }
    segundos();

    axios.post('{{route("getCode.user.retiro")}}', {

    })
    .then(function (response) {
            console.log(response);
    })
    .catch(function (error) {
            console.log(error);
    });
}
</script>