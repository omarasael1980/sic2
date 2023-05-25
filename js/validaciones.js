const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  password: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,12}$/ 
  , // 8 a 12 digitos.
	//password: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,14}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
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
  console.log("presionando");
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
// const formulario = document.getElementById('formulario');
// const inputs = document.querySelectorAll('#formulario input');
// const expresiones = {
//   usuario: /^[a-zA-Z0-9_-]{4,16}$/, // Letras, numeros, guion y guion_bajo
//   nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
//   password: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,12}$/, // 8 a 12 digitos.
//   correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
//   telefono: /^\d{7,14}$/ // 7 a 14 numeros.
// };

// const campos = {
//   usuario: false,
//   password: false
// };

// const validarCampo = (expresion, input, campo) => {
//   const grupo = document.getElementById(`grupo__${campo}`);
//   const mensajeError = document.getElementById(`mensaje_error__${campo}`);
//   const formGroupClassToAdd = expresion.test(input.value) ? 'form-group-correct' : 'form-group-wrong';
//   const formGroupClassToRemove = expresion.test(input.value) ? 'form-group-wrong' : 'form-group-correct';
//   const messageClassToAdd = expresion.test(input.value) ? 'form-message' : ' form-message-active';
//   const messageClassToRemove = expresion.test(input.value) ? 'form-message-active' : 'form-message';
  
//   grupo.classList.remove(formGroupClassToRemove);
//   grupo.classList.add(formGroupClassToAdd);
//   mensajeError.classList.remove(messageClassToRemove);
//   mensajeError.classList.add(messageClassToAdd);
  
//   campos[campo] = expresion.test(input.value);
// };

// const validarFormulario = (e) => {
//   switch(e.target.name) {
//     case 'usuario':
//       validarCampo(expresiones.usuario, e.target, 'usuario');
//       break;
//     case 'password':
//       validarCampo(expresiones.password, e.target, 'password');
//       break;
//     case 'nombre':
//       validarCampo(expresiones.nombre, e.target, 'nombre');
//       break;
//   }
// };

// inputs.forEach((input) => {
//   input.addEventListener('keyup', validarFormulario);
//   input.addEventListener('blur', validarFormulario);
// });

// formulario.addEventListener('submit', (e) => {
//   e.preventDefault();
  
//   const formGroupsCorrect = document.querySelectorAll('.form-group-correct');
  
//   if (formGroupsCorrect.length === Object.keys(campos).length) {
//     const token = document.createElement('input');
//     token.setAttribute('type', 'hidden');
//     token.setAttribute('name', 'token');
    
//     const action = document.createElement('input');
//     action.setAttribute('type', 'hidden');
//     action.setAttribute('name', 'action');
//     action.setAttribute('value', 'registro');
    
//     grecaptcha.ready(() => {
//       grecaptcha.execute('6LfXTVocAAAAACROczlljJmPqjALPJdP7n1tVjV6', { action: 'registro' }).then((token) => {
//         token.setAttribute('value', token);
//         formulario.appendChild(token);
//         formulario.appendChild(action);
//         formulario.submit();
//       });
//     });
//   } else {
//     document.getElementById('mensaje_error__formulario').classList.add('form-message-active');
//      document.getElementById('mensaje_error__formulario').classList.remove('form-message');
//   }
// });
