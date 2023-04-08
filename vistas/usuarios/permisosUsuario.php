<?php
include '../../modelo/usuarios/usuarios.php';
include '../../modelo/config/comunes.php';
$permisos = buscaPermisos();
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Directivo',$_SESSION['user']->perm)){
    header("Location:../../");
}
?>
<?php require '../complementos/header_2.php';?>
<?php require '../complementos/nav_2.php';?>


<!-- body  -->

    <div class="row">
        
    
        
          
        <Center><h1>Asignación de permisos</h1></Center>
       <?php foreach ($permisos as $rol): ?>
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <hr>
               <center> <strong><h2><?=$rol['name']?></h2></strong></center>
                    <form class="form-control" action="../../controlador/usuarios/ajustarPermisos.php" method="post">
                      <input type="text"name="perfil" hidden value="<?=$rol['id']?>">
                       
                        <?php foreach ($rol['permisos'] as $perm): ?>
                            
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                      
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"> 
                                                <h4 style ="color:black;"><b><?=$perm->permisos?></b></h4></div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <input class="" name="permisos[]" value="<?=$perm->idPermisos?>" 
                                            type="checkbox" <?=$perm->set ? 'checked': ''?>></div>
                                         
                                    </div>
                        <?php endforeach?>
                        <div class="row">
                        <div class="col-lg-4 col-md-3 col-sm-2 col-xs-0"></div>
                        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                        <button type="submit" class=" form-control btn btn-success">Guardar </button></div>
                    
                    </form>
                    </div>
        </div>
        <?php endforeach?>
        </div>
    </div>


<?php require '../complementos/footer_2.php';?>
