document.getElementById("libro").addEventListener("keyup", getLibros)

function getLibros() {

    let inputLibro = document.getElementById("libro").value
    let listaLibro = document.getElementById("listaLibro")

    if (inputLibro.length > 0) {
        const regex = /[a-zA-Z0-9 ]+$/;
        if(regex.test(inputLibro)){
    
         console.log("correcto");
         document.getElementById("libro").value = inputLibro.trimStart();
         //correcto
         
        }else{//incorrecto
     console.log("incorrecto");
     document.getElementById("libro").value = "";
    
 
     }
        let url = "../../modelo/biblioteca/getLibros.php"
        let formData = new FormData()
        formData.append("libro", inputLibro)

        fetch(url, {
            method: "POST", 
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
                listaLibro.style.display = 'block'
                listaLibro.innerHTML = data
            })
            .catch(err => console.log(err))
    } else {
        listaLibro.style.display = 'none'
    }
}

function mostrar(libro) {
    listaLibro.style.display = 'none'
    document.getElementById("libro").value=libro
    

} 