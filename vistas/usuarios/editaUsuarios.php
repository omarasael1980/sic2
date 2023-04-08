<?php
include_once '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user']) || !in_array('Directivo',$_SESSION['user']->perm)){
  header("Location:../../");
}
?>
<?php require '../complementos/header_2.php';
      require '../complementos/nav_2.php';
     
      require '../../modelo/config/comunes.php';

$roles = buscaRoles();
$usuarios = cargaUsuarios();

?>


<!-- body  -->

    <div class="row">
        <div class="col-lg-2 col-md-1 col-sm-0 col-xs-0"></div>
        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
          <center><h1>Editar Usuarios</h1></center>
        
       
        </div>
    </div>


        


    <table class="table col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;" >
        <!-- Se cargan los usuarios con sus datos   -->     
  <thead class="thead-dark " style="background:black;color:white;  ">
    <tr>
      
      <th  scope="col" hidden> id </th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido Paterno</th>
      <th scope="col">Apellido Materno</th>
      <th scope="col">Usuario</th>
      <th scope="col">Password</th>
      <th scope="col">Tipo de usuario</th>
      <th scope="col">acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($usuarios as $us):?>
        
    <tr class="" >
   
      <td hidden><?=$us->idUsuario?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->nombre?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->apaterno?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->amaterno?></td>
      <td style="border-top: 1px solid rgb(58, 56, 56);"><?=$us->user?></td>
      <td type="password"style="border-top: 1px solid rgb(58, 56, 56);">**********</td>
      <td style="border-top: 1px solid rgb(58, 56, 56);">
      
      <select name="roles" disabled >
      <?php foreach ($roles as $rol):?>  
       
  <option value="<?=$rol->idRol?>" <?php if($us->roles_idRol == $rol->idRol){echo ' Selected';}?>><?=$rol->rol?></option>
  <?php endforeach?>
</select>

</td>
      <td style="border-top: 1px solid rgb(58, 56, 56);">
        <!--Editar usuarios-->
        <a href="actualizaUsuarios.php?id=<?=$us->idUsuario?>"><img class="user-icono" src="../../img/icons/edit.png" alt="usuario"> </a>
         <!--Borrar usuarios-->
        <a href="../../controlador/usuarios/eliminarUsuario.php?id=<?=$us->idUsuario?>"><img class="user-icono" src="../../img/icons/delete.png" alt="usuario"> </a>
    </td>
    </tr>
   
    <?php endforeach?>
   
  </tbody>
</table>
        
   

   
        


<?php require '../complementos/footer_2.php';?>

