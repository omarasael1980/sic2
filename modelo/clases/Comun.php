<?php
function buscarAlumno($id){
    require 'pdo.php';
    $query ="SELECT * FROM sics.estudiantes JOIN grupos ON grupos_idgrupos = idgrupos WHERE idestudiantes = :id";
    $st = $pdo->prepare($query);
    $st->bindParam(':id',$id);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $alumno=$st->fetchAll(PDO::FETCH_OBJ);
          return $alumno;
      }else{
        return false;
      
   }
}
?>
