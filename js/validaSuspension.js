const formulario = document.getElementById('formulario');
const fecha = document.getElementById('fecha');
const motivo = document.getElementById('motivo');
const fechaInicial = document.getElementById('fechaInicial');
const fechaFinal = document.getElementById('fechaFinal');
const descripcion = document.getElementById('descripcion');


function validadescripcion(valor) {
    console.log(valor);
    const descripcionElement = document.getElementById('grupo__descripcion');
    const mensajeErrorElement = document.getElementById('mensaje_error__descripcion');
    const valorLimpio = quitaEspacios(valor,"descripcion");
    const valorCorregido = revisaMay('descripcion');
    console.log(valorCorregido);
    document.getElementById('descripcion').value = valorCorregido;
  
    if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ,;:\s]+$/.test(valorCorregido) || valorCorregido.length < 10) {
      descripcionElement.classList.remove('form-group-correct');
      descripcionElement.classList.add('form-group-wrong');
      mensajeErrorElement.classList.add('form-message-active');
    } else {
      descripcionElement.classList.add('form-group-correct');
      descripcionElement.classList.remove('form-group-wrong');
      mensajeErrorElement.classList.remove('form-message-active');
    }
  }
  
  function quitaEspacios(cadena,ninput){
  
    cadena =document.getElementById(ninput).value = cadena.trimStart();
    //correcto
    document.getElementById(ninput).value = cadena;
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
  function revisaMay(valor) {
    const wordElement = document.getElementById(valor);
    const word = wordElement.value;
    const a = primeraMay(word);
    wordElement.value = a;
    return a;
  }
  
//   function primeraMay(palabra) {
//     if (typeof palabra !== 'string') {
//       throw TypeError("El valor no es una palabra permitida");
//     }
//     return palabra.replace(/\b\w/g, c => c.toUpperCase());
//   }
  

formulario.addEventListener('submit', (e) => {
  let errores = [];
  
  // Validación de la fecha
  const hoy = new Date();
  const fechaSeleccionada = new Date(fecha.value);
  const tresDiasAntes = new Date(hoy.setDate(hoy.getDate() - 3));
  if (fechaSeleccionada < tresDiasAntes || fechaSeleccionada > new Date()) {
    errores.push('La fecha debe estar dentro del rango de los últimos 3 días.');
    document.getElementById('img-fecha').src = '../../img/icons/cross.png';
  } else {
    document.getElementById('img-fecha').src = '../../img/icons/check.png';
  }
  
  // Validación del motivo
  if (motivo.value == 0) {
    errores.push('Selecciona un motivo de suspensión.');
    document.getElementById('mensaje_error__motivo').style.display = 'block';
  } else {
    document.getElementById('mensaje_error__motivo').style.display = 'none';
  }
  
  // Validación de la fecha final
  if (fechaFinal.value < fechaInicial.value) {
    errores.push('La fecha final debe ser posterior a la fecha inicial.');
    document.getElementById('mensaje_error__fechaFinal').style.display = 'block';
  } else {
    document.getElementById('mensaje_error__fechaFinal').style.display = 'none';
  }
  
  // Validación de la descripción
  const descripcionRegex = /^[a-zA-Z0-9,.\s]*$/;
  if (!descripcionRegex.test(descripcion.value)) {
    errores.push('La descripción solo debe contener letras, números, coma, espacio y punto.');
    document.getElementById('mensaje_error__descripcion').style.display = 'block';
  } else {
    document.getElementById('mensaje_error__descripcion').style.display = 'none';
  }
  
  // Si hay errores, se impide el envío del formulario y se muestra un mensaje de error
  if (errores.length > 0) {
    e.preventDefault();
    const mensajeError = document.createElement('div');
    mensajeError.classList.add('alert', 'alert-danger', 'mt-3');
    mensajeError.textContent = 'Por favor, corrige los siguientes errores:\n' + errores.join('\n');
    formulario.appendChild(mensajeError);
  }
});
