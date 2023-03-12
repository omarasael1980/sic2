function ocultar(id){
    var des = 'desc';
    
console.log(des);
var marca = document.getElementsByClassName('desc'+id);
for(var i=0; i<marca.length;i++){

marca[i].classList.toggle('desaparece');
}

}