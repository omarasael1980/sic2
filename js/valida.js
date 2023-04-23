const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s]).{8,12}$/ 
  , // 8 a 12 digitos.
  domicilio: /^[a-zA-Z0-9À-ÿ,.\s]{1,100}$/, // 8 a 100 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{3}-\d{3}-\d{4}$/ // 10  numeros 343-233-4322.
}

const campos={
  usuario: false,
  password: false, 
  nombre: false,
  apaterno:false,
  amaterno: false,
  domicilio:false,
  tel:false, 
  cell:false  
}
const validarCampo = (expresion, input, campo)=>{
  if(expresion.test(input.value)){
    document.getElementById(`grupo__${campo}`).classList.remove('form-group-wrong');
   document.getElementById(`grupo__${campo}`).classList.add('form-group-correct');
   document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message-active');
  // document.getElementById(`mensaje_error__${campo}`).classList.add('form-message');
   campos[campo]=true;
  }else{
    document.getElementById(`grupo__${campo}`).classList.remove('form-group-correct');
    
    document.getElementById(`grupo__${campo}`).classList.add('form-group-wrong');
    document.getElementById(`mensaje_error__${campo}`).classList.add('form-message-active');
    //document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message');
    campos[campo]=false;
  }
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
    let letras = palabra.split(' ');
    return letras.map(p=>p[0].toUpperCase()+p.slice(1)).join(' ');
  }
}
function telefono(e){
  var numero = e;
 console.log(e.length);
 if(e.length == 3 ||e.length == 7){
 numero = e +"-";
 }
 return numero;
  
}

const validarFormulario = (e)=>{
  console.log(e.target.value);
switch(e.target.name){
case "usuario":
  quitaEspacios(e.target.value,"usuario");
  validarCampo(expresiones.usuario,e.target,'usuario');

  
    break;
case "password":
  quitaEspacios(e.target.value,"password");
  validarCampo(expresiones.password,e.target,'password');
      break;
case "nombre":
  quitaEspacios(e.target.value,"nombre");
  validarCampo(expresiones.nombre, e.target, 'nombre');
  document.getElementById("nombre").value = ( primeraMay(e.target.value));
  
  break;
case 'apaterno':
  quitaEspacios(e.target.value,"apaterno");
  validarCampo(expresiones.nombre, e.target, 'apaterno');
  document.getElementById("apaterno").value = ( primeraMay(e.target.value));
  break;
case 'amaterno':
  quitaEspacios(e.target.value,"amaterno");
  validarCampo(expresiones.nombre,e.target,'amaterno');
  document.getElementById("amaterno").value = ( primeraMay(e.target.value));
  break;
case 'domicilio':
  quitaEspacios(e.target.value,"domicilio");
  validarCampo(expresiones.domicilio,e.target,'domicilio');
  break;
case 'tel':
  quitaEspacios(e.target.value,"tel");
  validarCampo(expresiones.telefono,e.target,'tel');
  document.getElementById('tel').value = telefono(e.target.value);
  break;
case 'cell':
  quitaEspacios(e.target.value,"cell");
  validarCampo(expresiones.telefono,e.target,'cell');
  document.getElementById('cell').value = telefono(e.target.value);
  break;

}
}
inputs.forEach((input)=>{
input.addEventListener('keyup', validarFormulario);
input.addEventListener('blur', validarFormulario);
});

