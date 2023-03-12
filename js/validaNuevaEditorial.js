const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {

	editorial: /^[a-zA-ZÀ-ÿ\s]{1,80}$/, // Letras y espacios, pueden llevar acentos.
	
}
const campos={
  editorial: false
 
 
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
    document.getElementById(`mensaje_error__${campo}`).classList.remove('form-message');
    campos[campo]=false;
  }
}
function quitaEspacios(cadena,ninput){
  console.log("correcto");
cadena =document.getElementById(ninput).value = cadena.trimStart();
//correcto
document.getElementById(ninput).value = cadena;
}
function primeraMaydemasMin(palabra){
  
  if(typeof palabra != 'string'){
    throw TypeError("El valor no es una palabra permitida");
  }else{
    let letra =  palabra[0].toUpperCase();

   let resto = palabra.substr(1).toLowerCase();
    console.log(letra+resto);
    
    return letra+resto;
  
  }
}
const validarFormulario = (e)=>{
  
switch(e.target.name){
case "editorial":
  quitaEspacios(e.target.value,"editorial");
  validarCampo(expresiones.editorial,e.target,'editorial');
  e.target.value = primeraMaydemasMin(e.target.value);
 
    break;

}
}
inputs.forEach((input)=>{
input.addEventListener('keyup', validarFormulario);
input.addEventListener('blur', validarFormulario);
});
formulario.addEventListener('submit', (e)=>{

if(campos.editorial){
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
