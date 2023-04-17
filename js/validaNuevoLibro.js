const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const expresiones = {

	autor: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	titulo: /^[a-zA-Z0-9 #?!]{4,50}$/, // letras y numeros de 4 a 50 letras
	isbn: /^\d{12,13}$/ // 12 a 13 numeros.
}
const campos={
  titulo: false, 
  autor: false,
  
  isbn: false 

}
function primeraMay(palabra){
  if(typeof palabra != 'string'){
    throw TypeError("El valor no es una palabra permitida");
  }else{
    let letras = palabra.split(' ');
    var cadena =letras.map(p=>p[0].toUpperCase()+p.slice(1)).join(' ')
    console.log(cadena);
    return cadena;
  }
}
function isbnFormato(myIsbn){
  if(myIsbn.length == 3){
    myIsbn = myIsbn+"-"
  }
  console.log(myIsbn);
  return myIsbn;
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
 
switch(e.target.name){
case "titulo":
  quitaEspacios(e.target.value,"titulo");
  validarCampo(expresiones.titulo,e.target,'titulo');
  document.getElementById("titulo").value = primeraMaydemasMin(e.target.value);
  
    break;
case "autor":
  quitaEspacios(e.target.value,"autor");
  validarCampo(expresiones.autor,e.target,'autor');
  document.getElementById("autor").value = primeraMay(e.target.value);
  console.log("a:  "+primeraMay(e.target.value));
      break;
case "isbn":
  quitaEspacios(e.target.value,"isbn");
  validarCampo(expresiones.isbn, e.target, 'isbn');
  //document.getElementById("isbn").value = isbnFormato(e.target.value);

}
}
inputs.forEach((input)=>{
input.addEventListener('keyup', validarFormulario);
input.addEventListener('blur', validarFormulario);
});
formulario.addEventListener('submit', (e)=>{

if(campos.titulo && campos.autor && campos.isbn){
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
