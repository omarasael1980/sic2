
    <?php
   include '../../modelo/usuarios/usuarios.php';
   abreSesion();
   if(!isset($_SESSION['user'])){
       header("Location:../../");
   }
    $nombrecompleto = $_POST["alumno"];
    if(strpos($nombrecompleto, '/') == false){
        //si no contiene / no existe en la base de datos y redirige a la misma pagina pero sin post
        header("Location:../../vistas/enfermeria/eprincipal.php");
        ?>
        <script>console.log("ingreso imposible");</script>
        
        <?php
         }else{
    $separador ='/';
    $separada = explode($separador,$nombrecompleto);
    $nombre = $separada[0];
    $apaterno = $separada[1];
    $amaterno = $separada[2];
    $grupo = $separada[3];
    $idAlumno = $separada[4];
    ?>
    <script>console.log("ingreso permitido");</script>
    
    <?php
    header("Location: ../../vistas/enfermeria/expedienteAlumno.php?id=".$idAlumno);
 
         }
    ?>

