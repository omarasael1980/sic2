<?php require 'complementos/header.php';?>

<?php 
require '../modelo/config/pdo.php';
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Ajustes',$_SESSION['user']->perm)){
  header("Location:../../");
}
$usuarios = dameUsuarios($pdo);
$roles = damePerfiles($pdo);
?>

<!-- body  -->
<div class="container">
    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
          
        <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;" >
        <!-- Se cargan los usuarios con sus datos   -->     
  <thead class="thead-dark " style="background:black;color:white;">
    <tr>
      
      <th  scope="col"> Nombre</th>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Usuario</th>
      <th scope="col">Contrasena</th>
      <th scope="col">Rol</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($usuarios as $user):?>
    <tr>
    
      <td><?=$user->nombre?></td>
      <td><?=$user->apaterno?></td>
      <td><?=$user->amaterno?></td>
      <td><?=$user->user?></td>
      <td></td>
      <td>
     
      <select name="roles" disabled >
      <?php foreach ($roles as $rol):?>  
  <option value="<?=$rol->idRol?>" <?php if($user->idUsuario == $rol->idRol){echo 'Selected';}?>><?=$rol->rol?></option>
  <?php endforeach?>
</select>

</td>
      <td>
        <!--Editar usuarios-->
        <a href="conEditarUsuario.php?id=<?=$user->idUsuario?>"><img class="user-logo" src="../img/icons/edit.png" alt="usuario"> </a>
         <!--Borrar usuarios-->
        <a href="conBorrarUsuario.php?id=<?=$user->idUsuario?>"><img class="user-logo" src="../img/icons/delete.png" alt="usuario"> </a>
    </td>
    </tr>
    <?php endforeach?>
   
  </tbody>
</table>

            
        </div>
       
    </div>
</div>

<?php require 'complementos/footer.php';?>