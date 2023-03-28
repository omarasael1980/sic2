//validacion de campos
const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const textarea = document.querySelectorAll('#formulario  textarea');
const expresiones = {
	
	
	asunto: /^[a-zA-ZÀ-ÿ\s0-9,.]{4,40}$/, // Letras y espacios, pueden llevar acentos.
    destinatario: /^[a-zA-ZÀ-ÿ\s.]{4,40}$/, // Letras y espacios, pueden llevar acentos.
    mensaje:  /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ¡¿.,;:()-–—“”‘’\[\]{}\s]*$/, // Letras y espacios, pueden llevar acentos.
}
const campos={
    asunto :false,
    destinatario: false,
    mensaje: false,
 
 
  
 
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
function capitalizarFrase(frase) {
  
    var palabras = frase.split(" ");
   
    var palabrasCapitalizadas = [];
    
    for (var i = 0; i < palabras.length; i++) {
      var palabraCapitalizada = palabras[i].charAt(0).toUpperCase() + palabras[i].slice(1).toLowerCase();
      palabrasCapitalizadas.push(palabraCapitalizada);
    }
    // Une las palabras capitalizadas en una sola cadena 
    var fraseCapitalizada = palabrasCapitalizadas.join(" ");
    return fraseCapitalizada;
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
case "asunto":
  //quitaEspacios(e.target.value,"motivo");
  validarCampo(expresiones.asunto,e.target,'asunto');
  document.getElementById("asunto").value=primeraMaydemasMin(e.target.value);
    break;
case "destinatario":
 // quitaEspacios(e.target.value,"desc");
 
  var frase = document.getElementById("destinatario").value;
     document.getElementById("destinatario").value= capitalizarFrase(frase);
     validarCampo(expresiones.destinatario,e.target,'destinatario');
      break;
case "mensaje":
// quitaEspacios(e.target.value,"desc");
console.log("prueba"+expresiones.mensaje.test(textarea.value));
var mimensaje = false;
         if( expresiones.mensaje.test(textarea.value)){
mimensaje=true;
         }else{
mimensaje=false;
         }
   
    
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

if(campos.asunto && campos.destinatario && mimensaje){
  formulario.submit();

document.querySelectorAll('form-group-correct').forEach((icon)=>{
icon.classList.remove('form-group-correct');

});
}else{
  console.log("asunto:"+campos.asunto + " destinatario: "+campos.destinatario+" mensaje:"+mimensaje);
  e.preventDefault(); //previene que al presionar no se mande sin verificacion


}
});

//termina validacion de campos

//convertir html a pdf
document.addEventListener("DOMContentLoaded", () => {
    // Escuchamos el click del botón
    const $boton = document.querySelector("#imprimirCanalizacion");
    $boton.addEventListener("click", () => {
        const $elementoParaConvertir = document.getElementById("cuerpoImpresion"); // <-- Aquí puedes elegir cualquier elemento del DOM
        html2pdf()
            .set({
                margin: 1,
                filename: 'canalizacion.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3, // A mayor escala, mejores gráficos, pero más peso
                    letterRendering: true,
                },
                jsPDF: {
                    unit: "in",
                    format: "a4",
                    orientation: 'portrait' // landscape o portrait
                }
            })
            .from($elementoParaConvertir)
            .save()
            .catch(err => console.log(err));
    });
});
//configuracion  de impresiones 
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  