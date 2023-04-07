
    <?php
    

    	
   
    require '../../modelo/usuarios/usuarios.php';
    $usuario =$_POST['usuario'];
    $pass= $_POST['password'];


    $resp = logearAlumno($usuario, $pass);

    abreSesion();
    $error = $_SESSION['msg'];

    $tipo=$error['tipo'];
    $msg = $error['msg'];
    header("Location: ../../vistas/alumnos/ingresoAlumnos.php?tipo=".$tipo."&&msg=".$msg);


    ?>



