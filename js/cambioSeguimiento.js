
function actualizaSeg(folio){
   

    Swal.fire({
    title: '¿Seguro de eliminar la etiqueta de seguimiento?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: "No",
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  }).then((result) => {
    if (result.value) {
    // se guarda el cambio del checkbox
     //console.log(folio);
     let formData = new FormData();
     var elemento = 'seguimientoPsico'+folio;
     var foliox= folio;
     //console.log(elemento);
   estado = document.getElementById(elemento).checked;
   //  console.log(checkbox);
   
 
 formData.append('seguimiento', estado);
 formData.append('folio', folio);
 console.log('folio:' + folio);
 
 // Crear una solicitud HTTP POST y enviar los datos
 fetch('../../controlador/psicopedagogico/actualizar_estado.php', {
         method: 'POST',
         body: formData
     }).then(datos => datos.json())
     .then(datosrecibidos =>{
         console.log(datosrecibidos);
         location.reload();
     })
    }
    location.reload();
    return false;

  })
  
}





