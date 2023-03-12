
//valida el formulario del modal para agregar especialistas

function validaEspecialidad(){
    primeraMaydemasMin('miEspecialista'); 
    var campo = document.getElementById("miEspecialista");
    var cadena = campo.value;
    const regex = /^[A-Za-zÀ-ÿ0-9]{5,}$/;
   var res2 = mensajes(regex, cadena, "miEspecialista");
  return res2;
}


//valida el modal para agregar categorias

function validaMiCategoria(){
    primeraMaydemasMin('miCategoria'); 
    var campo = document.getElementById("miCategoria");
    var cadena = campo.value;
    const regex = /^[A-Za-zÀ-ÿ0-9]{5,}$/;
    var res4 =mensajes(regex, cadena, "miCategoria");

    return res4;
}



// Agregamos el evento submit al formulario categoria
function validaME(event){
  var esp = document.getElementById("miEspecialista").value;

  if(esp == ""){
    event.preventDefault();
    console.log("espeidad vacia");
  }
  if(validaEspecialidad()==false){
    event.preventDefault();
    console.log("mal especialidad");
  }
  
  
}


// Agregamos el evento submit al formulario especialidad
function validaMC(event){
  var mcat = document.getElementById("miCategoria").value;
  if(mcat == ""){
    event.preventDefault();
    console.log("catego vacia");
  }
  if(validaMiCategoria()==false){
    event.preventDefault();
    console.log("mal categoria");
  }
 
}
  
//funcion para remover los espacios vacios al inicio

function quitaEspacios(cadena,ninput){

cadena =document.getElementById(ninput).value = cadena.trimStart();
console.log("cadena");
console.log(cadena);
//correcto
document.getElementById(ninput).value = cadena;
}
function primeraMaydemasMin(campito){

   var  palabra = document.getElementById(campito).value;
    quitaEspacios(palabra, campito);
    palabra = document.getElementById(campito).value;
  
  if(typeof palabra != 'string'){
    throw TypeError("El valor no es una palabra permitida");
  }else{
    let letra =  palabra[0].toUpperCase();

   let resto = palabra.substr(1).toLowerCase();
   
    var res = letra + resto;
   document.getElementById(campito).value=res;
 
  
  }
}

//funciona para poner o quitar mensajes de error al hacer la validacion de cadenas
function mensajes(regex, cadena, nombreCampo){
    if(regex.test(cadena)){
       mensajes2('bien',nombreCampo);
       return true;
    }else{
      mensajes2('mal',nombreCampo);
        return false;
    }
}
function mensajes2(resultado, nombreCampo){
  if(resultado =='bien'){
      console.log("bien2");
      document.getElementById(`grupo__${nombreCampo}`).classList.remove('form-group-wrong');
     document.getElementById(`grupo__${nombreCampo}`).classList.add('form-group-correct');
     document.getElementById(`mensaje_error__${nombreCampo}`).classList.remove('form-message-active');
     document.getElementById(`mensaje_error__${nombreCampo}`).classList.add('form-message');
     return true;
  }else if(resultado == 'mal'){
      console.log("mal2");
      document.getElementById(`grupo__${nombreCampo}`).classList.remove('form-group-correct');
      document.getElementById(`grupo__${nombreCampo}`).classList.add('form-group-wrong');
      document.getElementById(`mensaje_error__${nombreCampo}`).classList.add('form-message-active');
      return false;
  }
}
//validacion de campo descripcion 
function validarDesc() {
 primeraMaydemasMin('descripcion'); 
 var campo = document.getElementById("descripcion");
 var cadena = campo.value;
 const regex = /^[A-Za-zÀ-ÿ0-9,. ]{7,}$/;
 var resultado = mensajes(regex, cadena, "descripcion");
 console.log("des    "+resultado)
 return resultado;


}


  
// Seleccionamos el formulario
const formulario = document.getElementById("formulario");

// Agregamos el evento submit al formulario
formulario.addEventListener("submit", (event) => {
  // Validamos los campos que deseemos, en este caso el campo especialista y el campo categoria
  const especialista = document.getElementById("especialista");
  const categoria = document.getElementById("categoria");
  //validar la descripcion 
  if( validarDesc()== false){
   
    event.preventDefault();
  }
  //validar la fecha 
  var fechaActual = new Date();
  var fechaMenor = new Date(document.getElementById("fecha").min);
  console.log(fechaMenor);
  var fechaSeleccionada = new Date(document.getElementById("fecha").value);
  if (fechaSeleccionada <= fechaActual && fechaSeleccionada >=fechaMenor) {
    mensajes2("bien", "fecha");
    console.log("bien fehca");

    // la fecha seleccionada es menor o igual a la fecha actual
  }else{
    mensajes2("mal", "fecha");
    console.log("mala fehca");
    event.preventDefault();
  }
  


  if (especialista.value == "0") {
    // Si el campo especialista no tiene un valor válido, mostramos el mensaje de error y prevenimos el envío del formulario
    mensajes2('mal','especialista');
    event.preventDefault();
  } else {
    // Si el campo especialista tiene un valor válido, ocultamos el mensaje de error
    mensajes2('bien','especialista');
  }
  
  if (categoria.value == "0") {
    // Si el campo categoria no tiene un valor válido, mostramos el mensaje de error y prevenimos el envío del formulario
    mensajes2('mal','categoria');
    event.preventDefault();
  } else {
    // Si el campo categoria tiene un valor válido, ocultamos el mensaje de error
    mensajes2('bien','categoria');
  }

});
