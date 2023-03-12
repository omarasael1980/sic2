<?php

// funcion para insertar usuarios
function ponerPermisos($rol, $permisos, $pdo){
  $query= "CALL delete_permisos(:perfil)";
  $stmt = $pdo->prepare($query);
  $stmt->bindparam(":perfil", $rol);
  $stmt->execute() or die (implode (" >> ", $stmt->errorInfo()));
      if(isset($permisos)){
          //insertar los permisos recibidos
          $query = "CALL insert_GuardaPermisos (:perfil, :permiso)";
          $stmt=$pdo->prepare($query);
          foreach($permisos as $perm){
            $data=  array('perfil'=>$rol, "permiso"=>$perm);
            $stmt->execute($data) or die ($stmt->errorInfo());

           }
      }
  return true;
}


function insertarUsuario($nombre, $apaterno, $amaterno, $username, $pass, $rol, $dom, $tel,$cel){
 
  require '../../modelo/config/pdo.php';
  
      $query1 = "select * from usuario where user = :username";//procedimiento select_buscarUsuario(user); no sirve por codigo 1267 illegal mix of collations
      $stm = $pdo->prepare($query1);
      $stm->bindParam(':username',$username);
      $stm->execute() or die($stm->errorInfo());

      if($stm->rowCount()>0){
        exit('Este usuario ya existe');
      }
      $query= "CALL insert_nuevoUsuario(:nombre, :apaterno, :amaterno, :username, :pass,:rol,:dom,:tel,:cel);";
      
     
      $consulta= $pdo->prepare($query);
      $pass =password_hash($pass, PASSWORD_BCRYPT);
      $consulta->bindparam(":nombre",$nombre);
      $consulta->bindparam(":apaterno",$apaterno);
      $consulta->bindparam(":amaterno",$amaterno);
     $consulta->bindparam(":username",$username);
      $consulta->bindparam(":pass",$pass);
      $consulta->bindparam(":rol",$rol);
      $consulta->bindparam(":dom",$dom);
      $consulta->bindparam(":tel",$tel);
      $consulta->bindparam(":cel",$cel);
      $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
      if($consulta->rowCount()>0){
                return true;
      }else{
        return false;
      }

}

function editaUsuarios2($nombre, $apaterno, $amaterno, $pass, $idrol ,$dom,$tel,$cell, $iduser, $pdo){
  $query = "UPDATE `sisantee_sics`.`usuario` SET `nombre` = :nombre, `apaterno` =:apaterno,
   `amaterno` = :amaterno,  `pass` = :pass, `roles_idRol` = :idrol, `domicilio` = :dom, `tel` = :tel, `cell` =:cell
   WHERE (`idUsuario` =  :idUser);";
  $stmt=$pdo->prepare($query);
  $stmt->bindParam(':nombre',$nombre);
  $stmt->bindParam(':apaterno',$apaterno);
  $stmt->bindParam(':amaterno',$amaterno);
  
  $pass=password_hash($pass, PASSWORD_BCRYPT);
  $stmt->bindParam(':pass',$pass);
  $stmt->bindParam(':idrol', $idrol);
  $stmt->bindParam(':dom',$dom);
  $stmt->bindParam(':tel',$tel);
  $stmt->bindParam(':cell',$cell);
 
  $stmt->bindParam(':idUser',$iduser);

  $stmt->execute() or die(implode('>>', $stmt->errorInfo()));
  if($stmt->rowCount()>0){

      return true;
  }else{
      return false;
  }
}
function borrarUsuario($id, $pdo){
  $query = "CALL delete_Usuarios(:id)";
  $stmt=$pdo->prepare($query);
  $stmt->bindParam(':id',$id);

  $stmt->execute() or die(implode('>>', $stmt->errorInfo()));
  if($stmt->rowCount()>0){

      return true;
  }else{
      return false;
  }
}
function cargaUsuarios(){
  require '../../modelo/config/pdo.php';
  $query = "SELECT * FROM usuario";
  $stmt=$pdo->prepare($query);
  $stmt->execute() or die(implode('>>', $stmt->errorInfo()));
  if($stmt->rowCount()>0){

      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }else{
      return false;
  }
}
function cargarUsuariosID($id){
  require '../../modelo/config/pdo.php';
  $query = "SELECT * FROM usuario WHERE idUsuario=:id";
  $stmt=$pdo->prepare($query);
  $stmt->bindParam(':id',$id);
  $stmt->execute() or die(implode('>>', $stmt->errorInfo()));
  if($stmt->rowCount()>0){

      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }else{
      return false;
  }
}


//funcion para logearse
function logearse($username, $password, $pdo){
    //busqueda de usuario
 
      $query= "SELECT * FROM usuario WHERE user = :username";
      $stmt=$pdo->prepare($query);

      $stmt->bindparam(":username",$username);
      $stmt->execute() or die (implode(" >> ", $stmt->errorInfo()));
     //Existe usuario
      if($stmt->rowCount()>0){
          $user=$stmt->fetch(PDO::FETCH_OBJ);
          
          //se verifica pass
          if(password_verify($password, $user->pass)){
            
            abreSesion();
             
             
            
              $query = "CALL select_buscarPermisosUsuario(:idrol); ";
           $stmt =$pdo->prepare($query);
           $stmt->bindParam(":idrol", $user->roles_idRol);
           $stmt->execute() or die (implode(">>", $stmt->errorInfo()));
           $user->perm = array();
           while($row = $stmt->fetch(PDO::FETCH_OBJ)){
            $user->perm[] = $row->permisos;
           unset($user->pass);
           unset($user->user);
           }
           $_SESSION['user']=$user;
           
           return 1;
          }else{
            $error=array("tipo"=>'error', "msg"=>'Contraseña incorrecta');
           
            $_SESSION['msg']=$error;
            return 2; //pass incorrecto
          }
      }else{
        $error=array("tipo"=>'error', "msg"=>'Usuario incorrecto');
           
        $_SESSION['msg']=$error;
        return 3;//el usuario no existe
      }
  }
 //funcion para iniciar sesiones
 function abreSesion(){
  if(!isset($_SESSION)){
      session_start();
  }
}
 
?>