<?php

// function hash(x){
//     seed =41;
//     diccionario ="abefimoprstuv";
//     for(i=0;i<x.lengh;i++){
//         seed = seed*19+diccionario.indexOf(x[i]);

//     }
//     return seed;
// }
//253674078499881

// function mis(){
          
        //     var x = document.getElementById("x");
        //     var cadena = x.value;
           
        //     var resultado = document.getElementById("resultado");
        //     var seed = 41;
        //     var diccionario = ["a", "b", "e", "f", "i", "m", "o", "p", "r", "s", "t", "u", "v"];
        //     for(var i=0; i<cadena.length; i++){
        //         var valor = cadena[i];
              
        //         seed = (seed * 19) + diccionario.indexOf(valor);
        //     }
        //     resultado.value = seed;
        //     console.log(seed);
        //     alert(seed);
        // }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="formulario" action="#" method="get">
        <input type="text" name="x" id="x">
        <input type="text" name="resultado" id="resultado">
       
    </form>
    <button onClick="res()">Calcula</button>

    <script>
        
   
        function res(){
           
            // var x = document.getElementById("x");
            // var resultado = document.getElementById("resultado");
            // var cadena = x.value;
            // var seed = 41;
            var diccionario = ["a", "b", "e", "f", "i", "m", "o", "p", "r", "s", "t", "u", "v"];
           // var v=document.getElementById("x").value;
            //se acota la busqueda
            // AAAAAAAAAA = 251373716569841
            // BAAAAAAAAA = 251696404267620
            // EAAAAAAAAA = 252019091965399
            // FAAAAAAAAA = 252341779663178
            // IAAAAAAAAA = 252664467360957
            // 
            console.log("vivo");
            var mayor = 0;
            var valor = 0;
            var v =253674078499881;
            console.log(v);
            var inicio = 41;
            var cadena = "";
            var exp = 9;
            for(var a = 0; a < 10; a++){
                    // se recorren los caracteres de la cadena
                 console.log("letra:"+a);
                 
            for(var y = 0; y <14; y++ ){ //se recorre el diccionario

                mayor = ((inicio*19)+ y ) * Math.pow(19,exp);
               
                if(mayor >v){
                   
                    valor  = y -1;
                    cadena = cadena + diccionario[valor];
                   corregido =  ((inicio*19)+ (y-1) ) * Math.pow(19,exp);
                   console.log("valor:"+corregido);
                    console.log("dif: "+(v-corregido));
                    alert("cadena= "+ cadena);
                    inicio = inicio*19 +valor;
                    console.log(cadena);
                    break;
                }
                
            }
            exp = exp -1;
            
        }





        //    var seed = 41;
         
              
        //         for(var i=0; i<13; i++){
                                    
        //             for(var j=0; j<13; j++){
                                        
        //                for(var m=0; m<13;m++){

        //                 for(var n=0; n<13; n++){
        //                     for(var o=0; o<13; o++){
        //                         for(var p=0; p<13; p++){
        //                             for(var q=0; q<13; q++){
        //                                 for(var r=0; r<13; r++){
        //                                     for(var s=0; s<13; s++){
        //                                         for(var t=0; t<13; t++){
        //                                             seed = (seed*19)+ i;
        //                                             seed = (seed*19)+ j;
        //                                             seed = (seed*19) +  m;
        //                                             seed = (seed*19) +  n;
        //                                             seed = (seed*19) +  o;
        //                                             seed = (seed*19) +  p;
        //                                             seed = (seed*19) +  q;
        //                                             seed = (seed*19) +  r;
        //                                             seed = (seed*19) +  s;
        //                                             seed = (seed*19) +  t;
        //                                             console.log(i+""+j+""+m+""+n+""+o+""+p+""+q+""+r+""+s+""+t);
        //                                             if(seed == v){
                                                     
        //                                                 var cadena = diccionario[i];
        //                                                 cadena = cadena+ diccionario[j];
        //                                                 cadena = cadena+ diccionario[m];
        //                                                 cadena = cadena+ diccionario[n];
        //                                                 cadena = cadena+ diccionario[o];
        //                                                 cadena = cadena+ diccionario[p];
        //                                                 cadena = cadena+ diccionario[q];
        //                                                 cadena = cadena+ diccionario[r];
        //                                                 cadena = cadena+ diccionario[s];
        //                                                 cadena = cadena+ diccionario[t];
        //                                                 resultado.value=cadena;
        //                                                 alert("Exito"+cadena);
                                                      
        //                                                break;
                                                    
        //                                             }
                                                
        //                                             seed =41;
        //                                         }
        //                                     }
        //                                 }
        //                             }
        //                         }

        //                     }
        //                 }
        //                }
                     
        //             }
                  
                   
                  
        //           }
                  
           
          
           
          
        
    }
            
        
    </script>
   
</body>
</html>
