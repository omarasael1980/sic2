const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const textarea = document.querySelectorAll('#formulario  textarea');
const expresiones = {
	
	motivo: /^[a-zA-ZÀ-ÿ\s]{4,100}$/, // Letras y espacios, pueden llevar acentos.
	desc: /^[a-zA-ZÀ-ÿ\s0-9,.]{4,300}$/, // Letras y espacios, pueden llevar acentos.
	
}
const campos={
  motivo: false, 
  desc: false,
 
  
 
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
function primeraMaydemasMin(palabra){
  if(typeof palabra != 'string'){
    throw TypeError("El valor no es una palabra permitida");
  }else{
    let letra =  palabra[0].toUpperCase();

   let resto = palabra.substr(1);
    console.log(letra+resto);
    
    return letra+resto;
  
  }
}
const validarFormulario = (e)=>{
  
switch(e.target.name){
case "motivo":
  //quitaEspacios(e.target.value,"motivo");
  validarCampo(expresiones.motivo,e.target,'motivo');
  document.getElementById("motivo").value=primeraMaydemasMin(e.target.value);
    break;
case "desc":
 // quitaEspacios(e.target.value,"desc");
  validarCampo(expresiones.desc,e.target,'desc');
  document.getElementById("desc").value=primeraMaydemasMin(e.target.value);
      break;
     

}
}
inputs.forEach((input)=>{
input.addEventListener('keyup', validarFormulario);
input.addEventListener('blur', validarFormulario);
});
textarea.forEach((ta)=>{

    ta.addEventListener('keyup', validarFormulario);
    ta.addEventListener('blur', validarFormulario);
    });
formulario.addEventListener('submit', (e)=>{

if(campos.motivo && campos.desc){
  formulario.submit();

document.querySelectorAll('form-group-correct').forEach((icon)=>{
icon.classList.remove('form-group-correct');

});
}else{
  console.log("error");
  e.preventDefault(); //previene que al presionar no se mande sin verificacion

  document.getElementById('mensaje_error__formulario').classList.add('me_formulario-active');
  document.getElementById('mensaje_error__formulario').classList.remove('me_formulario');
}
});
