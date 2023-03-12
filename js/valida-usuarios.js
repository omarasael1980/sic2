
formulario.addEventListener('submit', (e)=>{


if(campos.usuario && campos.password  && campos.apaterno && campos.amaterno && campos.domicilio && campos.tel && campos.cell){
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
 