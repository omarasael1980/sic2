function accion(){
   
    var ancla = document.getElementsByClassName('nav-bar');
    
    for(var i = 0; i < ancla.length; i++){
        ancla[i].classList.toggle('desaparece');
    }
}
