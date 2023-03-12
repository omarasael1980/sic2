<?php
function cargarExpediente($nombrecompleto, $pdo){

    $separador ='/';
    $separada = explode($separador,$nombrecompleto);
    $nombre = $separada[0];
    $apaterno = $separada[1];
    $amaterno = $separada[2];
    $grupo = $separada[3];
    $id = $separada[4];


}

function nuevaAtencion($motivo, $descripcion, $fecha, $idEstudiante, $idUsuario, $idCategoria,$pdo){
    
   
        $query= "CALL insert_atencionMedica($motivo, $descripcion,$fecha,$idEstudiante,$idUsuario, $idCategoria);";
        $consulta= $pdo->prepare($query);
        $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
        if($consulta->rowCount()>0){
         
            return true;
        }else{
          return false;
        
     }

}
function buscaAlumno(){

}
function cargaAtencionMedica($idAlumno, $pdo){
    $query = "CALL select_cargarExpedienteMedico(:alumno)";
    $rs = $pdo->prepare($query);
    $rs->binparam(":alumno", $idAlumno);
    $rs->execute() or die (implode(">>", $rs->errorInfo()));
    if($rs->rowCount()>0){
        $atenciones=$rs->fetchAll(PDO::FETCH_OBJ);
          return $atenciones;
      }else{
        return false;
      }
}


?>