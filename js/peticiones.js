document.getElementById("alumno").addEventListener("keyup", getAlumnos)

function getAlumnos() {

    let input = document.getElementById("alumno").value
    let lista = document.getElementById("lista")

    if (input.length > 0) {
        const regex = /[a-zA-Z0-9 ]+$/;
       if(regex.test(input)){
   
        console.log("correcto");
        document.getElementById("alumno").value = input.trimStart();
        //correcto
        
       }else{//incorrecto
    console.log("incorrecto");
    document.getElementById("alumno").value = "";
   
 
    }
         //si es mas de 0 caracteres
         let url = "../../modelo/alumnos/getAlumnos.php"
         let formData = new FormData()
         formData.append("alumno", input)
 
         fetch(url, {
             method: "POST", 
             body: formData,
             mode: "cors" //Default cors, no-cors, same-origin
         }).then(response => response.json())
             .then(data => {
                 lista.style.display = 'block'
                 lista.innerHTML = data
             })
             .catch(err => console.log(err))
             //cierra longitud
      
              
    } else {
        lista.style.display = 'none'
    }
}

function mostrar(alumno) {
    lista.style.display = 'none'
    document.getElementById("alumno").value=alumno
}

