

formulario.addEventListener('submit', (e)=>{
console.log ("verificando");
nombre = document.getElementById('nombre');
apaterno = document.getElementById('apaterno');
amaterno = document.getElementById('amaterno');
usuario = document.getElementById('usuario');
password = document.getElementById('password');
domicilio = document.getElementById('domicilio');
tel = document.getElementById('tel');
cell = document.getElementById('cell');
console.log (campos.nombre);
validarCampo(expresiones.nombre, nombre, "nombre");
validarCampo(expresiones.nombre, apaterno, "apaterno");
validarCampo(expresiones.nombre, amaterno, "amaterno");
validarCampo(expresiones.password, password, "password");
validarCampo(expresiones.domicilio, domicilio, "domicilio");
validarCampo(expresiones.usuario, usuario, "usuario");
validarCampo(expresiones.telefono, tel, "tel");
validarCampo(expresiones.telefono, cell, "cell");
revisa_selector();




  if(campos.usuario && campos.password  && campos.apaterno && campos.amaterno && campos.domicilio && campos.tel && campos.cell){
    formulario.submit();
  
  document.querySelectorAll('form-group-correct').forEach((icon)=>{
  icon.classList.remove('form-group-correct');
  document.getElementById('mensaje_error__formulario').classList.remove('me_formulario-active');
  document.getElementById('mensaje_error__formulario').classList.add('me_formulario');
  });
  }else{
    e.preventDefault(); //previene que al presionar no se mande sin verificacion
  
    document.getElementById('mensaje_error__formulario').classList.add('me_formulario-active');
    document.getElementById('mensaje_error__formulario').classList.remove('me_formulario');
  }
  });