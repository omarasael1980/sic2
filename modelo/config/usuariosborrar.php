<?php
 //funcion para iniciar sesiones
 function abreSesion(){
  if(!isset($_SESSION)){
      session_start();
  }
}
//funcion para insertar usuarios
function agregaUsuario($username,$password,$tipo,$pdo){

    if(trim($username)=="" or trim($password)==""){
        exit('Debes llenar los campos de usuario y password');
//Se busca si el usuario existe
    }else{
        $query = "SELECT * FROM user WHERE users = :username";
        $consulta = $pdo->prepare($query);
        $consulta->bindparam(":username",$username);
        $consulta->execute() or die(implode(" >> ", $consulta->errorInfo()));

        if($consulta->rowCount()>0){
            exit("El usuario ya existe");

        }else{//sino se inserta
          if($tipo==0){$tipo = "6";}
            $inserta = "INSERT INTO user (users, pass, rol_idrol) VALUES(:username, :passw, :idrol )";
            $consulta = $pdo->prepare($inserta);
            $password = password_hash($password,PASSWORD_BCRYPT);
            $consulta->bindparam(":username",$username);
            $consulta->bindparam(":passw", $password);
            $consulta->bindparam(":idrol", $tipo);
            $consulta->execute() or die(implode(" >> ",$consulta->errorInfo()));
            return ("listo");
        }
        
    }
}

//funcion para obtener usuarios
function dameUsuarios($pdo){
  $query= "SELECT idUsuario, nombre, apaterno, amaterno, user, roles_idRol FROM usuario";
  $consulta= $pdo->prepare($query);
  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $usuario=$consulta->fetchAll(PDO::FETCH_OBJ);
      return $usuario;
  }else{
    return false;
  }

}
//funcion para obtener perfiles
function damePerfiles($pdo){ 
  $query= "SELECT * FROM roles";
  $consulta= $pdo->prepare($query);
  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $perfil=$consulta->fetchAll(PDO::FETCH_OBJ);
      return $perfil;
  }else{
    return false;
  }

}
 // funcion para obtener los permisos por perfiles
 function damePerfilPermisos($pdo){
$query ="SELECT CONCAT(perfil, ',', permiso) AS pp FROM perfil_permiso";
$consulta = $pdo->prepare($query);
$consulta->execute() or die (implode(" >> ",$consulta->errorInfo()));
 if($consulta->rowCount()>0){
  $permiso = array();
  while($row = $consulta->fetch(PDO::FETCH_OBJ)){
    $permiso[]= $row->pp;
    
  }
 }else{
  return false;
 }
 return $permiso;
}
 //funcion para obtener permisos

 function damePermisos($pdo){
  //se buscan perfiles y permisos
  $perfiles = damePerfiles($pdo);
  $permisosPerfiles = damePerfilPermisos($pdo);
  //se almacenan 
  $todos = array();
  //se coimparan con los asignados para hacer sistema de checkbox
  foreach($perfiles as $perfil){
    $query = "SELECT * FROM permisos";
    $consulta = $pdo->prepare($query);
    $consulta->execute() or die (implode(" >> ", $consulta->errorInfo()));


  if($consulta->rowCount()>0){
    $permitidos = array();
    while($row = $consulta->fetch(PDO::FETCH_OBJ)){
      $row->concat = $perfil->idrol.",".$row->idPermiso;
      //para evitar error si no hay permisos
        if($permisosPerfiles){
            $row->set=in_array($row->concat,$permisosPerfiles);
          }else{
            $row->set=false;
          }
            $permitidos[]=$row;
        
        
    }
  }else{
    return false;
  }
  $all[]=array('id'=>$perfil->idrol, 'name'=>$perfil->rol, 'permisos'=>$permitidos);

  }
  return $all;
 }
//funcion para guardar permisos
function guardaPermisos($perfil, $permisos, $pdo){
  $query= "CALL delete_permisos(:perfil)";
  $stmt = $pdo->prepare($query);
  $stmt->bindparam(":perfil", $perfil);
  $stmt->execute() or die (implode (" >> ", $stmt->errorInfo()));
      if(isset($permisos)){
          //insertar los permisos recibidos
          $query = "CALL insert_GuardaPermisos (:perfil, :permiso)";
          $stmt=$pdo->prepare($query);
          foreach($permisos as $perm){
            $data=  array('perfil'=>$perfil, "permiso"=>$perm);
            $stmt->execute($data) or die ($stmt->errorInfo());

           }
      }
  return true;
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
            // se cargan los permisos del usuario
           $query = "CALL select_buscarPermisosUsuario(:idrol); ";
           $stmt =$pdo->prepare($query);
           $stmt->bindParam(":idrol", $user->roles_idRol);
           
           $stmt->execute() or die (implode(">>", $stmt->errorInfo()));
           $user->perm = array();
           while($row = $stmt->fetch(PDO::FETCH_OBJ)){
            $user->perm[] = $row->permisos;
           
           }
              $_SESSION['user']=$user;
                return 0;
          }else{
                return 1;
          }
      }else{
                return 2;
      }
  }

 
?>