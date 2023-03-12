function valida1(valor) {
    const cadena = document.getElementById(valor).value.trim();
    const isInvalid = !/^[a-zA-Z]{4,}$/.test(cadena);
    const grupoNombre = document.getElementById('grupo__nombre');
    const mensajeErrorNombre = document.getElementById('mensaje_error__nombre');
    
    if (isInvalid) {
      quitaEspacios(cadena, 'nombre');
      revisaMay(valor);
      
      grupoNombre.classList.remove('form-group-correct');
      grupoNombre.classList.add('form-group-wrong');
      mensajeErrorNombre.classList.add('form-message-active');
      console.log('a: false');
      return false;

    } else {
      quitaEspacios(cadena, 'nombre');
      revisaMay('nombre');
    
      grupoNombre.classList.add('form-group-correct');
      grupoNombre.classList.remove('form-group-wrong');
      mensajeErrorNombre.classList.remove('form-message-active');
      console.log('a: true');
      return true;
    }
    
    
  }
  function validaArchivo(){
    const archivoSeleccionado = document.getElementById('Archivo').files[0];
    if (!archivoSeleccionado) {
        // No se ha seleccionado ningún archivo
        console.log('No se ha seleccionado ningún archivo');
        console.log('b: false');
        return false;
        } else if (!/\.(pdf|jpeg|jpg|mp4)$/i.test(archivoSeleccionado.name)) {
        // El archivo seleccionado no es de tipo pdf, jpeg o mp4
        console.log('El archivo seleccionado no es de tipo pdf, jpeg o mp4');
        console.log('b: false');
        return false;
}else{
    console.log("Archivo correcto");
    console.log('b: true');
    return true;
}

  }
  function quitaEspacios(cadena,ninput){
    
      cadena =document.getElementById(ninput).value = cadena.trimStart();
      //correcto
      document.getElementById(ninput).value = cadena;
      }

      function revisaMay(valor){
           var word =  document.getElementById(valor).value;
           document.getElementById(valor).value = primeraMay(word);
           
          }
          function quitaEspacios(cadena,ninput){
            
          cadena =document.getElementById(ninput).value = cadena.trimStart();
          //correcto
          document.getElementById(ninput).value = cadena;
          }
          function primeraMay(palabra){
            if(typeof palabra != 'string'){
              throw TypeError("El valor no es una palabra permitida");
            }else{
              let letras = palabra.split('.');
              
              return letras.map(p=>p[0].toUpperCase()+p.slice(1)).join(' ');
            }
          }
  
     
       
          
          
          // Obtener referencia al formulario
          var formulario = document.getElementById("formulario");
          const grupoNombre = document.getElementById('grupo__nombre');
          const mensajeErrorNombre = document.getElementById('mensaje_error__nombre');
          const grupoArchivo = document.getElementById('grupo__Archivo');
          const mensajeErrorArchivo = document.getElementById('mensaje_error__Archivo');
          const miArchivo = document.getElementById('Archivo');
      
          // Agregar evento "submit" al formulario
                 formulario.addEventListener("submit", function(event) {
              var nombre = formulario.nombre.value.trim();
              var archivo = formulario.imagen.value;
              var extension = archivo.substring(archivo.lastIndexOf('.') + 1).toLowerCase();
      
              // Validar campo "nombre"
              if (nombre == "") {
                  //alert("Debes escribir un nombre para el archivo, solo se permiten letras");
                    grupoNombre.classList.remove('form-group-correct');
                    grupoNombre.classList.add('form-group-wrong');
                    mensajeErrorNombre.classList.add('form-message-active');
                  event.preventDefault();
                 // alert("sis4");
                  return false;
              }
      
              // Validar campo "Archivo"
              if (archivo == "") {
                  //alert("Debes seleccionar un archivo (pdf, jpg, mp4)");
                  grupoArchivo.classList.remove('form-group-correct');
                  grupoArchivo.classList.add('form-group-wrong');
                  mensajeErrorArchivo.classList.add('form-message-active');
                 // alert("sis3");
                  event.preventDefault();
                  miArchivo.value = "";
                  return false;
              } else if (extension != "pdf" && extension != "jpg" && extension != "mp4") {
                 // alert("El archivo seleccionado no es válido. Solo se permiten archivos de tipo pdf, jpg y mp4");
                  grupoArchivo.classList.remove('form-group-correct');
                  grupoArchivo.classList.add('form-group-wrong');
                  mensajeErrorArchivo.classList.add('form-message-active');
                //  alert("sis2");
                  event.preventDefault();
                  miArchivo.value = "";
                  return false;
              }
           
              grupoArchivo.classList.add('form-group-correct');
              grupoArchivo.classList.remove('form-group-wrong');
              mensajeErrorArchivo.classList.remove('form-message-active');
             
              return true;
          });
     
      
      
    
      

  