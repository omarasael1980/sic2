<?php
//Solicitar los perfiles
function buscaRoles(){
   require 'pdo.php';
   $query= "CALL select_roles";
   $consulta= $pdo->prepare($query);
   $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
   if($consulta->rowCount()>0){
     $roles=$consulta->fetchAll(PDO::FETCH_OBJ);
       return $roles;
   }else{
     return false;
   }
}

//buscar grupos
function buscarGrupoS(){
  require 'pdo.php';
  $query = "CALL select_buscaGrupo();";
  $st= $pdo->prepare($query);
  $st->execute() or die (implode(">>", $st->errorInfo()));
  if($st->rowCount()>0){
    $grupos = $st->fetchALL(PDO::FETCH_OBJ);
    return $grupos;
  }else{
    return false;
  }

}

//Buscar permisos 
function buscaPermisos(){
  require 'pdo.php';
 
 $perfiles = buscaRoles();
 $perfPermisos = buscaPermisosPerfil();
 $todo = array();
 foreach($perfiles as $perfil){
 
  $query = "SELECT * FROM permisos";
  $st = $pdo->prepare($query);
  $st->execute() or die (implode(">>",$st->errorInfo()));
  if($st->rowCount()>0){
    $permisos = array();
    while($row = $st->fetch(PDO::FETCH_OBJ)){
      $concat = $perfil ->idRol.','.$row->idPermisos;
      if($perfPermisos){
      $row->set = in_array($concat,$perfPermisos);
      }else{
        $row->set = false;
      }
      $permisos[] = $row;
     
    }
  }else{
    return false;
  }
  $todo[]= array('id'=>$perfil->idRol, 'name'=>$perfil->rol, 'permisos'=>$permisos);

 }
 return $todo;
}
function buscaPermisosPerfil(){
  require 'pdo.php';
  $query = "SELECT CONCAT (roles_idRol,',',permisos_idPermisos) as perm  FROM roles_has_permisos;";
  $st = $pdo->prepare($query);
  $st->execute() or die (implode(">>", $st->errorInfo()));
  if($st->rowCount()>0){
    $perm = array();
    while($row = $st->fetch(PDO::FETCH_OBJ)){
      $perm[]= $row->perm;
    }
  }else{
    return false;
  }
  return $perm;
}
//Buscar datos alumno por id
function buscaAlumno($id){
  require 'pdo.php';
  $query= "Select * from estudiantes JOIN grupos ON grupos_idgrupos = idgrupos Where idestudiantes=:id";
  $consulta= $pdo->prepare($query);
  $consulta->bindParam(':id',$id);
  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $al=$consulta->fetchAll(PDO::FETCH_OBJ);
      return $al;
  }else{
    return false;
  }
}
//obtener alumnos para generar tokens
function buscaTokens(){
  require 'pdo.php';
  $query= "Select nombre, apaterno, amaterno, user , pass as token, grupo from estudiantes JOIN grupos ON grupos_idgrupos = idgrupos";
  $consulta= $pdo->prepare($query);

  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $al=$consulta->fetchAll(PDO::FETCH_OBJ);
      return $al;
  }else{
    return false;
  }
}
//obtener alumnos para generar tokens
function buscSettings(){
  require 'pdo.php';
  $query= "CALL select_buscaSettings();";
  $consulta= $pdo->prepare($query);

  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $ajustes=$consulta->fetchAll(PDO::FETCH_OBJ);
      return $ajustes;
  }else{
    return false;
  }
}
//actrualiza setting
function actualizaSettings($fic, $ih, $fh, $diasA, $diasD){
  require 'pdo.php';
  $query= "CALL update_actualizaSettings (:fic, :ih,:fh, :diasA, :diasD);";
  $consulta= $pdo->prepare($query);
  $consulta->bindParam(":fic", $fic);
  $consulta->bindParam(":ih", $ih);
  $consulta->bindParam(":fh", $fh);
  $consulta->bindParam(":diasA", $diasA);
  $consulta->bindParam(":diasD", $diasD);
  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
    $ajustes=$consulta->fetchAll(PDO::FETCH_OBJ);
      return true;
  }else{
    return false;
  }
}
//actrualiza monto seguro escolar
function actualizaMontoSeguroEscolar($monto){
  require 'pdo.php';
  $query= "UPDATE `sisantee_sics`.`settings` SET `montoSeguro` = :monto WHERE (`idsettings` = '1');";
  $consulta= $pdo->prepare($query);
  $consulta->bindParam(":monto", $monto);

  $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
  if($consulta->rowCount()>0){
 
      return true;
  }else{
    return false;
  }
}
//filtrar alumnos
function getAlumnos($string,$pdo){
  $campo = $_POST["alumno"];

$sql = "CALL select_getAlumnos($string. '%')";
$query = $pdo->prepare($sql);
$query->execute();

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
$html .= "<li  onclick=\"mostrar('" . $row["nombre"] . "/".$row["apaterno"]."/".$row["amaterno"]."/".$row["grupo"]."' )\">" . $row["nombre"] . " - " . $row["apaterno"] ."  /  " . $row["amaterno"] ."  /  " . $row["grupo"]. "</li>";
}
echo json_encode($html, JSON_UNESCAPED_UNICODE);
//respaldo
$campo = $_POST["alumno"];

$sql = "SELECT * FROM estudiantes  WHERE nombre LIKE ? OR apaterno LIKE ? OR amaterno LIKE ? ORDER BY apaterno ASC LIMIT 0, 5";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%', $campo . '%',$campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$html .= "<li  onclick=\"mostrar('" . $row["nombre"] . "/".$row["apaterno"]."/".$row["amaterno"]."/".$row["grupo"]."' )\">" . $row["nombre"] . " - " . $row["apaterno"] ."  /  " . $row["amaterno"] ."  /  " . $row["grupo"]. "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
}

?>