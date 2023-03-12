<?php require 'complementos/header.php';?>

<?php 
require '../modelo/config/pdo.php';
require '../modelo/config/usuarios.php';
$usuarios = dameUsuarios($pdo);
$roles = damePerfiles($pdo);
?>

<!-- body  -->
<div class="container">
    <div class="row">
       <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <form  class="form-control"action="../controlador/control/editaUsuario.php" method="post" >
            <?php foreach($usuarios as $user):?>
              <?php  if($_GET["id"]==$user->idUsuario):?>
                <div class="col-lg-12">  <p>Nombre:</p><input  class="form-control" type="text" name="nombre" value=<?=$user->nombre?>>
                </div>
                
              
                
                  <div class="col-lg-12"><p>Apellido Paterno:</p><input class="form-control"  type="text" name="apaterno" value=<?=$user->apaterno?>></div> 
                  <div class="col-lg-12"><p>Apellido Materno:</p> <input class="form-control"  type="text" name="amaterno" value=<?=$user->amaterno?>></div>
                  <div class="col-lg-12"> <p>Usuario:</p><input  class="form-control" type="text" name="usuario" value=<?=$user->user?>></div>
                  <div class="col-lg-12"> <p>Password:</p><input class="form-control"  type="text" name="pass" value=""></div>
                   <select  class="form-control" name="roles"  >
                        <?php foreach ($roles as $rol):?>  
                            <option value="<?=$rol->idRol?>" <?php if($user->idUsuario == $rol->idRol){echo 'Selected';}?>><?=$rol->rol?></option>
                        <?php endforeach?>
                    </select>

                    <?php endif ?>
                        <?php endforeach?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <p class="center "><button class="btn btn-primary form-control" type="submit">
                    Entrar</button></p> 
                        
                    </div>
          </form></div>
       
            
      
       
    </div>
</div>

<?php require 'complementos/footer.php';?>