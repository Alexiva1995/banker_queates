<script>
     let wallet = 0;
     let Monto_a_retirar = 0;
     let ButtonContinue = 0;

    function w(){
        let value = document.getElementById('wallet').value;
        let Value_Monto = document.getElementById('Monto_a_retirar').value;
        let value_ButtonContinue = document.getElementById('continue-button');

        wallet = value;
        Monto_a_retirar = Value_Monto;
        ButtonContinue = value_ButtonContinue;
        percentage( Monto_a_retirar);
        if( wallet.length > 16 &&  Monto_a_retirar > 49 ){
            console.log(Monto_a_retirar);
            ButtonContinue.disabled = false;
        }else{
        (wallet.value);
        ButtonContinue.disabled = true;
            console.log(Monto_a_retirar);

        }
    }

function pegar(e){
    let ButtonContinue = document.getElementById('continue-button');

    setTimeout(function(){
        if( e.value.length > 16 &&  Monto_a_retirar > 49 ){
            console.log(e.value.length);
            ButtonContinue.disabled = false;
        }else{
        (wallet.value);
        ButtonContinue.disabled = true;

        }
    }, 4);

}

function activarInput(e){
    Monto_a_retirar = e;
    percentage(Monto_a_retirar);

    if( wallet.length > 16 &&  Monto_a_retirar > 49 ){

        ButtonContinue.disabled = false;

    }else{
        (wallet.value);
        ButtonContinue.disabled = true;

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


function getCode(){
    let codeButton = document.getElementById('codeButton');
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

function verificarRetiro(){
    let title = document.getElementById('title');
    let body = document.getElementById('body');
    let footer = document.getElementById('footer');
    let passed = document.getElementById('passed');
    let contenedorspiner = document.getElementById('contenedorspiner');
    let spiner = document.getElementById('spiner');


    axios.post('{{route("verificar.user.retiro")}}', {
        code: document.getElementById('code').value,
        Monto_a_retirar: document.getElementById('Monto_a_retirar').value,
        wallet: document.getElementById('wallet').value,
        type:'comissions',
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

function reload(){
    window.location.reload();
}


function email_trasnfer(e){
    axios.post('{{route("liquidaciones.trasferir")}}', {
    email: e,
  })
  .then(function (response) {
    let sin_resultado = document.getElementById('sin_resultado');
    let resultado = document.getElementById('resultado');
    let input = document.getElementById('input');
    let success = document.getElementById('success');
    let close = document.getElementById('close');

   if( response.data.value != 'sin_resultados'){
    console.log(response.data.value);
    resultado.hidden = false;
    sin_resultado.hidden = true;
    success.hidden = false;
    close.hidden = true;
    input.style.borderColor = "#28C76F";
    success.style.borderColor = "#28C76F";
   }else{
    sin_resultado.hidden = false;
    resultado.hidden = true;
    success.hidden = true;
    close.hidden = false;
    input.style.borderColor = "#FF4969";
    close.style.borderColor = "#FF4969";
   }
  })
  .catch(function (error) {
    console.log(error);
  });
}
function max(){
    const avaibleBalanceTotal = @json($availableBalanceComision);
    let Monto_a_retirar =  document.getElementById('Monto_a_retirar');
    Monto_a_retirar.value = avaibleBalanceTotal;
    w();
}
</script>
