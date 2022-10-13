<script>
    function previewFile(input, preview_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#" + preview_id).attr('src', e.target.result);
                    $("#" + preview_id).css('height', '90px');
                    $("#" + preview_id).parent().parent().removeClass('d-none');
                }
                $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
                reader.readAsDataURL(input.files[0]);
            }
        }

    function checkRadius(value){
        console.log(value);
        let TarjetaIdentificacion = document.getElementById('TarjetaIdentificacion');
        let Pasaporte = document.getElementById('Pasaporte');
        let LicenciaConducir = document.getElementById('LicenciaConducir');
           if(value == 'TarjetaIdentificacion'){
            Pasaporte.checked = false;
            LicenciaConducir.checked = false;
           }
           if(value == 'Pasaporte'){
            TarjetaIdentificacion.checked = false;
            LicenciaConducir.checked = false;

           }if(value == 'LicenciaConducir'){
            Pasaporte.checked = false;
            TarjetaIdentificacion.checked = false;
           }
    }

</script>
