function errorVacio(){
    alert("Error");
    //se selecciona el label 

    var errorLabel = document.getElementById("error");
    errorLabel.value = "Este titulo no existe, pero puedes guardar uno nuevo en el boton azul";
    errorLabel.removeAttribute("hidden");
}