function validadescripcion(valor){
     
    if(!/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ,.;:\s]+$/.test(valor)|| valor.length < 10){
     
      revisaMay('descripcion');
      quitaEspacios(valor,'descripcion');
     
      document.getElementById(`grupo__descripcion`).classList.remove('form-group-correct');
      document.getElementById(`grupo__descripcion`).classList.add('form-group-wrong');
      document.getElementById(`mensaje_error__descripcion`).classList.add('form-message-active');
     
    }else{
     
      revisaMay('descripcion');
      quitaEspacios(valor,'descripcion');
    
      document.getElementById(`grupo__descripcion`).classList.add('form-group-correct');
      document.getElementById(`grupo__descripcion`).classList.remove('form-group-wrong');
      document.getElementById(`mensaje_error__descripcion`).classList.remove('form-message-active');
      
    }
  }
  function quitaEspacios(cadena,ninput){
  
  cadena =document.getElementById(ninput).value = cadena.trimStart();
  //correcto
  document.getElementById(ninput).value = cadena;
  }
  
  function revisaMay(valor){
    console.log("tag2");
   var word =  document.getElementById(valor).value;
   var a = primeraMay(word);
  console.log(a);
   document.getElementById(valor).value = a; 
   
  }
  function primeraMay(palabra){
  
    if(typeof palabra != 'string'){
      throw TypeError("El valor no es una palabra permitida");
    }else{
      let letras = palabra.split('.');
      let convertido = letras.map(p=>p[0].toUpperCase()+p.slice(1)).join(' ');
    
    
      return convertido;
    }
  }
  //validacion de modal categoria
  function validaMiCategoria(e){
    fmiCategoria = document.getElementById("fmiCategoria");
    miCategoria = document.getElementById("miCategoria");
  
    fmiCategoria.addEventListener('submit',(e)=>{
   
   
      if(miCategoria.value == ""){
        document.getElementById(`grupo__miCategoria`).classList.remove('form-group-correct');
        document.getElementById(`grupo__miCategoria`).classList.add('form-group-wrong');
        document.getElementById(`mensaje_error__miCategoria`).classList.add('form-message-active');
  
      }else{
        if(!/^[a-zA-Z\s]+$/.test(miCategoria.value)){
          document.getElementById(`grupo__miCategoria`).classList.remove('form-group-correct');
          document.getElementById(`grupo__miCategoria`).classList.add('form-group-wrong');
          document.getElementById(`mensaje_error__miCategoria`).classList.add('form-message-active');
          
        }else{
          document.getElementById(`grupo__miCategoria`).classList.add('form-group-correct');
        document.getElementById(`grupo__miCategoria`).classList.remove('form-group-wrong');
        document.getElementById(`mensaje_error__miCategoria`).classList.remove('form-message-active');
          miCategoria.value = primeraMay(miCategoria.value);
          
          fmiCategoria.submit();
  
        }
       
      }
      
  
  });
  }
  
  //validacion de modal motivo
  
     function validaMiMotivo(e){
        fmiMotivo = document.getElementById("fmiMotivo");
        miMotivo = document.getElementById("miMotivo");
  
        fmiMotivo.addEventListener('submit',(e)=>{
       
        e.preventDefault();
          if(miMotivo.value == ""){
            document.getElementById(`grupo__miMotivo`).classList.remove('form-group-correct');
            document.getElementById(`grupo__miMotivo`).classList.add('form-group-wrong');
            document.getElementById(`mensaje_error__miMotivo`).classList.add('form-message-active');
  
          }else{
            if(!/^[a-zA-Z\s]+$/.test(miMotivo.value)){
              document.getElementById(`grupo__miMotivo`).classList.remove('form-group-correct');
              document.getElementById(`grupo__miMotivo`).classList.add('form-group-wrong');
              document.getElementById(`mensaje_error__miMotivo`).classList.add('form-message-active');
            }else{
              document.getElementById(`grupo__miMotivo`).classList.add('form-group-correct');
            document.getElementById(`grupo__miMotivo`).classList.remove('form-group-wrong');
            document.getElementById(`mensaje_error__miMotivo`).classList.remove('form-message-active');
              miMotivo.value = primeraMay(miMotivo.value);
              fmiMotivo.submit();
            }
           
          }
          
  
      });
     }
  
      function validarForm(e){
        const xformulario = document.getElementById('formulario');
      const xfecha = document.getElementById('fecha');
      const xfechaCitatorio = document.getElementById('fechaCitatorio');
      const xmotivo = document.getElementById('motivo');
     
      const xdescripcion = document.getElementById('descripcion'); 
     
      
      function correcto(campo){
          document.getElementById(`grupo__${campo}`).classList.remove('form-group-wrong');
          document.getElementById(`grupo__${campo}`).classList.add('form-group-correct');
          document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message-active');
          document.getElementById(`mensaje_error__${campo}`).classList.add('form-message');
          
        }
      function error(campo){
          document.getElementById(`grupo__${campo}`).classList.remove('form-group-correct');
          document.getElementById(`grupo__${campo}`).classList.add('form-group-wrong');
          document.getElementById(`mensaje_error__${campo}`).classList.add('form-message-active');
          
         
      }
  
    xformulario.addEventListener('submit',(e)=>{
     
      var b1 =false;// valida descripcion
      var b2 =false; // valida fecha
      var b3 =false; //valida motivo
     var b4 = false; // valida fecha citatorio
      e.preventDefault();
      //validar fecha
      
      if(xfecha.value == null || xfecha.value == ''){
       error('fecha');
       
       b2 = false;
      }else{
          correcto('fecha');
          b2 = true;
      }
       //validar fecha citatorio
      
       if(xfechaCitatorio.value == null || xfechaCitatorio.value == ''){
        error('fechaCitatorio'); //
       
        b4 = false;
       }else{
        //establecer fecha minima y maxima y lograr comparar
       

            const fechaMin = new Date();
            fechaMin.setDate(fechaMin.getDate() + 1);
            fechaMin.setHours(0, 0, 0, 0);
            const fechaMinMS = fechaMin.getTime();

            const fechaMax = new Date();
            fechaMax.setDate(fechaMax.getDate() + 14);
            fechaMax.setHours(23, 59, 59, 999);
            const fechaMaxMS = fechaMax.getTime();

          const inputFecha = document.getElementById("fechaCitatorio");
          var fechaInput = new Date(Date.parse(inputFecha.value)).getTime();
          if (fechaInput < fechaMin || fechaInput > fechaMax) {
            alert("La fecha debe estar entre "+fechaMin+ " y el "+fechaMax);
            inputFecha.value = "";
            b4=false;
            error("fechaCitatorio");
          }else{
            //fin revision 
            correcto('fechaCitatorio');
            b4 = true;
                    }
        }
      
       
      //validar motivo
      if(xmotivo.value == 0){
          // si el combobox de motivo esta vacio
          error('motivo')
          
          b3 = false;
      }else{
          correcto('motivo');
          b3 = true;
      }
  
    // se valida la descripcion 
    
        
      if(!/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ,;:\s]+$/.test(xdescripcion.value)|| xdescripcion.value.length < 10){
        
      
        error('descripcion');
      
        b1 = false;
      }else{
       b1= true;
        correcto('descripcion');
       
        
      }
    
   
   if(b1 == true && b2 == true && b3 == true && b4==true ){
    console.log("b1"+b1);
    console.log("b2"+b2);
    console.log("b3"+b3);
    console.log("b4"+b4);
    xformulario.submit();
    
   }
    });

  
  }
  