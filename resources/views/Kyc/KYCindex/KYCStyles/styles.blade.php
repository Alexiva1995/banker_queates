<style>
    .fa{
        font-size: 3rem;
    }

        input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        content: '';
        display: inline-block;
        visibility: visible;
    }
    input[type='checkbox']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 1px;
        top: -30px;
        left: 100px;
        position: relative;
        content: '';
        display: inline-block;
        visibility: visible;
    }
    

   

    input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .cloud{
        -webkit-transition:all .3s ease; /* Safari y Chrome */
        -moz-transition:all .3s ease; /* Firefox */
        -o-transition:all .3s ease; /* IE 9 */
        -ms-transition:all .3s ease; /* Opera */
        width:100%;
        }
    .cloud:hover{
        -webkit-transform:scale(1.25);
        -moz-transform:scale(1.25);
        -ms-transform:scale(1.25);
        -o-transform:scale(1.25);
        transform:scale(1.25);
        }

        .cloud:active{
        -webkit-transform:scale(1);
        -moz-transform:scale(1);
        -ms-transform:scale(1);
        -o-transform:scale(1);
        transform:scale(1);
        }

        
 .file-select {
  position: relative;
  display: inline-block;
}

.file-select::before {
  background-color: #3490dc;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 3px;
  content: 'Selecionar foto'; /* testo por defecto */
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.file-select input[type="file"] {
  opacity: 0;
  width: 30px;
  height: 23px;
  display: inline-block;
}

#photo::before {
  content: '\f030';
  font-family: "Font Awesome 5 Free" ;
  font-weight: 900;
  font-size: 11px;
}

</style>
