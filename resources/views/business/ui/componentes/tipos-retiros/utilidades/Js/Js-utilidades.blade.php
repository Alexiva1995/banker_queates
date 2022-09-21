<script>
     let wallet_utilidades = 0;
     let Monto_a_retirar_utilidades = 0;
     let ButtonContinue_utilidades = 0;
    function pegar_utilidades(e){
        let ButtonContinue_utilidades  = document.getElementById('continue-button_utilidades');
    
        setTimeout(function(){
            Monto_a_retirar_utilidades = document.getElementById('Monto_a_retirar_utilidades').value;
            if( e.value.length > 16 &&  Monto_a_retirar_utilidades > 49 ){
                console.log(e.value.length);
                ButtonContinue_utilidades .disabled = false;
            }else{
            (wallet_utilidades.value);
            ButtonContinue_utilidades .disabled = true;
    
            }
        }, 4);
    console.log(Monto_a_retirar_utilidades);
    }
    
    function w_utilidades(){
            let value = document.getElementById('wallet_utilidades').value;
            let Value_Monto_utilidades = document.getElementById('Monto_a_retirar_utilidades').value;
            let value_ButtonContinue_utilidades  = document.getElementById('continue-button_utilidades');
    
            wallet_utilidades = value;
            Monto_a_retirar_utilidades = Value_Monto_utilidades;
            ButtonContinue_utilidades  = value_ButtonContinue_utilidades;
            percentage( Monto_a_retirar_utilidades);
            if( wallet_utilidades.length > 16 &&  Monto_a_retirar_utilidades > 49 ){
                console.log(Monto_a_retirar_utilidades);
                ButtonContinue_utilidades.disabled = false;
            }else{
            (wallet_utilidades.value);
            ButtonContinue_utilidades.disabled = true;
                console.log(Monto_a_retirar_utilidades);
    
            }
        }
        function activarInput_utilidades(e){
        Monto_a_retirar_utilidades = e;
        percentage(Monto_a_retirar_utilidades);
    
        if( wallet_utilidades.length > 16 &&  Monto_a_retirar_utilidades > 49 ){
            ButtonContinue_utilidades.disabled = false;
        }else{
            (wallet_utilidades.value);
            ButtonContinue_utilidades.disabled = true;
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
    
    function verificarRetiro_utilidades(){
        let title = document.getElementById('title_utilidades');
        let body = document.getElementById('body_utilidades');
        let footer = document.getElementById('footer_utilidades');
        let passed = document.getElementById('passed_utilidades');
        let contenedorspiner = document.getElementById('contenedorspiner_utilidades');
        let spiner = document.getElementById('spiner_utilidades');
    
    
        axios.post('{{route("verificar.user.retiro.utilidad")}}', {
            code: document.getElementById('code_utilidades').value,
            Monto_a_retirar: document.getElementById('Monto_a_retirar_utilidades').value,
            wallet: document.getElementById('wallet_utilidades').value,
        })
        .then(function (response) {
            if(response.data.value == 'no_es_paquete_oro_o_plata'){
                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Debes tener un paque Bonce o Plata  para retirar Utilidades!',
                showConfirmButton: false,
                timer: 1500
                })
            }
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
    
  
    
    function getCode_utilidades(){
        let codeButton = document.getElementById('codeButton_utilidades');
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