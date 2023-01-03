<!-- BEGIN: Vendor JS-->
<script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('vendors/js/extensions/toastr.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')

<!-- CDN JS-->
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- END: Page JS-->

<script>

  function getlink() {
    var aux = document.createElement("input");
    const lado = document.getElementById('binary').value;
    lado ? aux.setAttribute("value", "{{route('register')}}?buyer_id={{Auth::id()}}&binary="+lado) : aux.setAttribute("value", "{{route('register')}}?buyer_id={{Auth::id()}}&binary=L");
    document.body.appendChild(aux);
    aux.select();
    document.execCommand("copy");
    document.body.removeChild(aux);

    Swal.fire({
      title: "Copied Link",
      icon: 'success',
      text: "Now you can paste it in your browser",
      type: "success",
      //confirmButtonClass: 'btn btn-outline-primary'
      confirmButtonColor: '#07B0F2',
    })
  }

  function orden() {
    Swal.fire({
      title: "Error",
      icon: 'error',
      text: "Debe tener una licencia activa para poder acceder a su enlace de referidos",
      //confirmButtonClass: 'btn btn-outline-primary',
      confirmButtonColor: '#07B0F2',
    })
  }

  $(".progresscircle").each(function() {
    var value = $(this).attr('data-value');
    console.log("VALUE", value)

    var left = $(this).find('.progress-left .progress-circle');
    var right = $(this).find('.progress-right .progress-circle');

    if (value > 0) {
      if (value <= 50) {
        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
      } else {
        right.css('transform', 'rotate(180deg)')
        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
      }
    }

  })

  function percentageToDegrees(percentage) {
    return percentage / 100 * 360
  }

  let hiddenBtn = document.getElementById('hiddenBtn');
  let chooseBtn = document.getElementById('chooseBtn');

  hiddenBtn.addEventListener('change', function() {
    if (hiddenBtn.files.length > 0) {
      chooseBtn.innerText = hiddenBtn.files[0].name;
    } else {
      chooseBtn.innerText = 'Choose';
    }
  });

  let btn = document.getElementById("remove");
  let input = document.getElementById("hiddenBtn");

  btn.addEventListener('click', (e) => {

    input.value = null
    chooseBtn.innerText = 'Ajuntar archivo';

  })
  // use la API del navegador FormData para crear un conjunto de pares clave/valor que representan
  // campos de formulario y sus valores, para enviar usando el método XMLHttpRequest.send().
  // Usa el mismo formato que usaría un formulario con codificación multipart/form-data
  function upFile(file) {
    //solo permitir que se suelten las imágenes
    let imageType = /image.*/;
    if (file.type.match(imageType)) {
      let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
      // crear un objeto FormData
      let formData = new FormData();
      // agregue un nuevo valor a una clave existente dentro de un objeto FormData o agregue la
      // clave si no existe. la función de administrador de archivos se repetirá
      // cada archivo y enviarlo aquí para ser agregado
      formData.append('file', file);

      // configuración de búsqueda de carga de archivo estándar
      fetch(url, {
          method: 'put',
          body: formData
        })
        .then(response => response.json())
        .then(result => {
          console.log('Success:', result);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    } else {
      console.error("¡Solo se permiten imágenes!", file);
    }
  }


  /*use la API de FileReader para obtener los datos de la imagen, cree un elemento img y agregue
    a la galería div. La API es asíncrona, por lo que onloadend se usa para obtener el
    resultado de la función API */
  function previewFile(file) {
    // solo permitir que se suelten las imágenes
    let imageType = /image.*/;
    if (file.type.match(imageType)) {

      let fReader = new FileReader();
      let gallery = document.getElementById('gallery');

      // lee el contenido del Blob especificado. el atributo de resultado de este
      // con retención de datos: URL que representa los datos del archivo
      fReader.readAsDataURL(file);
      // controlador para el evento final de carga, activado cuando la operación de lectura es
      // completado (ya sea éxito o fracaso)
      fReader.onloadend = function() {
        let wrap = document.createElement('div');
        let img = document.createElement('img');
        // establece el atributo img src en el contenido del archivo (desde la operación de lectura)
        document.getElementById('logos').classList.add("hidden");
        document.getElementById('label').classList.add("hidden");

        img.src = fReader.result;
        let imgCapt = document.createElement('p');
        /// la propiedad de nombre del archivo contiene el nombre del archivo
        imgCapt.innerHTML = `<span class="fName">${file.name}</span>`;
        gallery.appendChild(wrap).appendChild(img);
        gallery.appendChild(wrap).appendChild(imgCapt);
      }
    } else {
      console.error("¡Solo se permiten imágenes!", file);
    }
  }

  function filesManager(files) {
    // distribuir la matriz de archivos de la propiedad DataTransfer.files en una nueva
    // matriz de archivos aquí


    files = [...files];
    // envía cada elemento de la matriz tanto a upFile como a previewFile
    // funciones
    files.forEach(upFile);
    files.forEach(previewFile);
  }








  // use la API del navegador FormData para crear un conjunto de pares clave/valor que representan
  // campos de formulario y sus valores, para enviar usando el método XMLHttpRequest.send().
  // Usa el mismo formato que usaría un formulario con codificación multipart/form-data
  function subirArchivo(files) {
    //solo permitir que se suelten las imágenes
    let imageType = /image.*/;
    if (files.type.match(imageType)) {
      let ruta = 'HTTP/HTTPS URL TO SEND THE DATA TO';
      // crear un objeto FormData
      let formDatas = new FormData();
      // agregue un nuevo valor a una clave existente dentro de un objeto FormData o agregue la
      // clave si no existe. la función de administrador de archivos se repetirá
      // cada archivo y enviarlo aquí para ser agregado
      formDatas.append('file', files);

      // configuración de búsqueda de carga de archivo estándar
      fetch(ruta, {
          method: 'put',
          body: formDatas
        })
        .then(response => response.json())
        .then(result => {
          console.log('Success:', result);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    } else {
      console.error("¡Solo se permiten imágenes!", files);
    }
  }


  /*use la API de FileReader para obtener los datos de la imagen, cree un elemento img y agregue
    a la galería div. La API es asíncrona, por lo que onloadend se usa para obtener el
    resultado de la función API */
  function verArchivo(files) {
    // solo permitir que se suelten las imágenes
    let imageTypes = /image.*/;
    if (files.type.match(imageTypes)) {

      let reader = new FileReader();
      let imagen = document.getElementById('gallery2');

      // lee el contenido del Blob especificado. el atributo de resultado de este
      // con retención de datos: URL que representa los datos del archivo
      reader.readAsDataURL(files);
      // controlador para el evento final de carga, activado cuando la operación de lectura es
      // completado (ya sea éxito o fracaso)
      reader.onloadend = function() {
        let wrap = document.createElement('div');
        let imagenes = document.createElement('img');
        // establece el atributo img src en el contenido del archivo (desde la operación de lectura)
        document.getElementById('logos2').classList.add("hidden");
        document.getElementById('label2').classList.add("hidden");

        imagenes.src = reader.result;
        let imgCap = document.createElement('p');
        /// la propiedad de nombre del archivo contiene el nombre del archivo
        imgCap.innerHTML = `<span class="fName">${files.name}</span>`;
        imagen.appendChild(wrap).appendChild(imagenes);
        imagen.appendChild(wrap).appendChild(imgCap);
      }
    } else {
      console.error("¡Solo se permiten imágenes!", files);
    }
  }

  function filesManagers(files) {
    // distribuir la matriz de archivos de la propiedad DataTransfer.files en una nueva
    // matriz de archivos aquí
    files = [...files];
    // envía cada elemento de la matriz tanto a upFile como a previewFile
    // funciones
    files.forEach(subirArchivo);
    files.forEach(verArchivo);
  }




  function mandaFoto(file) {

    let imageType = /image.*/;
    if (file.type.match(imageType)) {
      let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
      // create a FormData object
      let formData = new FormData();
      // add a new value to an existing key inside a FormData object or add the
      // key if it doesn't exist. the filesManager function will loop through
      // each file and send it here to be added
      formData.append('file', file);

      // standard file upload fetch setup
      fetch(url, {
          method: 'post',
          body: formData
        })
        .then(response => response.json())
        .then(result => {
          console.log('Success:', result);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    } else {
      console.error("Only images are allowed!", file);
    }
  }


  // use the FileReader API to get the image data, create an img element, and add
  // it to the gallery div. The API is asynchronous so onloadend is used to get the
  // result of the API function
  function muestraFoto(file) {
    // only allow images to be dropped
    let imageType = /image.*/;
    if (file.type.match(imageType)) {
      let fReader = new FileReader();
      let images = document.getElementById('foto');
      // reads the contents of the specified Blob. the result attribute of this
      // with hold a data: URL representing the file's data
      fReader.readAsDataURL(file);
      // handler for the loadend event, triggered when the reading operation is
      // completed (whether success or failure)
      fReader.onloadend = function() {
        let wrapst = document.createElement('div');
        let imagen = document.createElement('img');
        // set the img src attribute to the file's contents (from read operation)
        imagen.src = fReader.result;
        let imgCapt = document.createElement('p');
        // the name prop of the file contains the file name, and the size prop
        // the file size. convert bytes to KB for the file size
        let fSize = (file.size / 1000) + ' KB';
        imgCapt.innerHTML = `<span class="fName">${file.name}</span><span class="fSize">${fSize}</span><span class="fType">${file.type}</span>`;
        images.appendChild(wrapst).appendChild(imagen);
        images.appendChild(wrapst).appendChild(imgCapt);
      }
    } else {
      console.error("Only images are allowed!", file);
    }
  }

  function fotoFile(files) {
    // spread the files array from the DataTransfer.files property into a new
    // files array here
    files = [...files];
    // send each element in the array to both the upFile and previewFile
    // functions
    files.forEach(mandaFoto);
    files.forEach(muestraFoto);
  }
</script>