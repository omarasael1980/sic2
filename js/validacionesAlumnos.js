const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	
  password: /^[a-zA-Z0-9\_\-]{10}$/

}
const campos={
  usuario: false, 
  password: false

}
const validarCampo = (expresion, input, campo)=>{
  if(expresion.test(input.value)){
    document.getElementById(`grupo__${campo}`).classList.remove('form-group-wrong');
   document.getElementById(`grupo__${campo}`).classList.add('form-group-correct');
   document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message-active');
   document.getElementById(`mensaje_error__${campo}`).classList.add('form-message');
   campos[campo]=true;
  }else{
    document.getElementById(`grupo__${campo}`).classList.remove('form-group-correct');
    
    document.getElementById(`grupo__${campo}`).classList.add('form-group-wrong');
    document.getElementById(`mensaje_error__${campo}`).classList.add('form-message-active');
   // document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message');
    campos[campo]=false;
  }
}
const validarFormulario = (e)=>{
  console.log("vivo");
switch(e.target.name){
case "usuario":
  validarCampo(expresiones.usuario,e.target,'usuario');
  
    break;
case "password":
  console.log("password");
  validarCampo(expresiones.password,e.target,'password');
      break;
case "nombre":
  validarCampo(expresiones.nombre, e.target, 'nombre');

}
}
inputs.forEach((input)=>{
//input.addEventListener('keyup', validarFormulario);
input.addEventListener('blur', validarFormulario);
});
formulario.addEventListener('submit', (e)=>{

if(campos.usuario && campos.password){
  formulario.submit();

document.querySelectorAll('form-group-correct').forEach((icon)=>{
icon.classList.remove('form-group-correct');

});
}else{
  e.preventDefault(); //previene que al presionar no se mande sin verificacion

  document.getElementById('mensaje_error__formulario').classList.add('me_formulario-active');
  document.getElementById('mensaje_error__formulario').classList.remove('me_formulario');
}
});

$('#formulario').submit(function(event) {
    event.preventDefault();
    
    grecaptcha.ready(function() {
        grecaptcha.execute('6LfXTVocAAAAACROczlljJmPqjALPJdP7n1tVjV6', {action: 'registro'}).then(function(token) {
            $('#formulario').prepend('<input type="hidden" name="token" value="' + token + '">');
            $('#formulario').prepend('<input type="hidden" name="action" value="registro">');
            $('#formulario').unbind('submit').submit();
        });
    });
});