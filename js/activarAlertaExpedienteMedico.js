
function actualizaSeg(folio){
  

    Swal.fire({
    title: '¿Seguro de cambiar la etiqueta de alerta',
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
     var elemento = 'seguimientoEM'+folio;
     var foliox= folio;
     //console.log(elemento);
   estado = document.getElementById(elemento).checked;
    
   if(estado == true){
    estado = 1;
   }else{
    estado = 0;
   }
 console.log(estado);
 console.log(folio);
 formData.append('seguimiento', estado);
 formData.append('folio', folio);
 

 // Crear una solicitud HTTP POST y enviar los datos
 fetch('../../controlador/enfermeria/actualizar_estadoEM.php', {
   
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

function agregar() {
    // Obtener el valor del div
    var medicamento = document.getElementById("medicamento").value;
  console.log(medicamento);
    // Obtener el valor actual del textarea
    var medicacionActual = document.getElementById("medicacion").value;
  
    // Agregar el nuevo valor al final del textarea
    document.getElementById("medicacion").value = medicacionActual + "\n" + medicamento;
    document.getElementById("medicamento").value="";
  }
  
  



