function validaxdescripcion(valor, id){

      
  if(!/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ,;:\s]+$/.test(valor)|| valor.length < 10){
   quitaEspacios(valor,'descripcion'+id);
    revisaMay('descripcion'+id);
    console.log('descripcion'+id);
    document.getElementById(`grupo__descripcion`+id).classList.remove('form-group-correct');
    document.getElementById(`grupo__descripcion`+id).classList.add('form-group-wrong');
    document.getElementById(`mensaje_error__descripcion`+id).classList.add('form-message-active');
   
  }else{
    quitaEspacios(valor,'descripcion'+id);
    revisaMay('descripcion'+id);
    document.getElementById(`grupo__descripcion`+id).classList.add('form-group-correct');
    document.getElementById(`grupo__descripcion`+id).classList.remove('form-group-wrong');
    document.getElementById(`mensaje_error__descripcion`+id).classList.remove('form-message-active');
    
  }
}
function revisaMay(valor){
 var word =  document.getElementById(valor).value;
 document.getElementById(valor).value = primeraMay(word);
 
}
function quitaEspacios(cadena,ninput){
  console.log("correcto");
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

    

//validacion de modal insertar motivo

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
   //valida los motivos del modal que agrega seguimiento de casos de psicologia
   function validaMotivo(e){
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
      const id = document.getElementById('folio');
      const xformulario = document.getElementById('formulario');
    const xfecha = document.getElementById('fecha');
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
    }
