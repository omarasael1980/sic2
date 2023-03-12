<?php
function buscaLibros($idUsuario){ //regresa los libros que tiene cada docente en custodia
    
    require '../../modelo/config/pdo.php';
    $query="CALL select_buscaLibrosporUsuario(:idusuario)";
    $st = $pdo->prepare($query);
    $st->bindParam(':idusuario',$idUsuario);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $libros=$st->fetchAll(PDO::FETCH_OBJ);
          return $libros;
      }else{
        return false;
      
   }
}
function buscaTodosLibros(){ //
    
  require '../../modelo/config/pdo.php';
 $query ="CALL select_buscaTodosLibros()";
 // $query="CALL select_buscaLibros";
  $st = $pdo->prepare($query);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $libros=$st->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }else{
      return false;
    
 }
}
function buscaLibroLeidoAlumno($idlibro, $idalumno){
  require '../../modelo/config/pdo.php';
  $query="CALL select_compruebaPrestamo(:idalumno, :idlibro)";

  $st = $pdo->prepare($query);
  $st->bindParam(":idalumno", $idalumno);
  $st->bindParam(":idlibro", $idlibro);
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
    $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
    return $prestamos;
    }else{
      return false;
    
 }
}
function buscaLibroIdlibro($idlibros){
  require '../../modelo/config/pdo.php';
  $query="CALL select_buscaLibrosIdLibros(:idlibros)";

  $st = $pdo->prepare($query);
  $st->bindParam(":idlibros", $idlibros);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $libros=$st->fetchAll(PDO::FETCH_OBJ);
        return $libros;
    }else{
      return false;
    
 }
}
function buscaEditoriales(){
  require '../../modelo/config/pdo.php';
  $query="CALL select_buscaEditoriales()";

  $st = $pdo->prepare($query);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $editoriales=$st->fetchAll(PDO::FETCH_OBJ);
        return $editoriales;
    }else{
      return false;
    
 }
}
//insertar nuevos libros
function agregarNuevoLibro($titulo, $autor, $editorial, $isbn){
  require '../../modelo/config/pdo.php';
 
  $query="CALL insert_nuevoLibro(:titulo,:autor,:editorial,:isbn)";
  $st = $pdo->prepare($query);
  $st->bindParam(":titulo", $titulo);
  $st->bindParam(':autor', $autor);
  $st->bindParam(':editorial', $editorial);
  $st->bindParam(':isbn', $isbn);
  
  $exitoA = $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($exitoA){
    return true;
  }else{
    return false;
  }
}
//guarda los prestamos de libros
function insertaPrestamo($fecha, $idestudiantes, $idEjemplar){
  require '../../modelo/config/pdo.php';
  $pdo->beginTransaction();
  $query="CALL insert_prestamoEjemplar (:fecha, :idestudiante, :idEjemplar)";
  $st = $pdo->prepare($query);
  $st->bindParam(":fecha", $fecha);
  $st->bindParam(':idestudiante', $idestudiantes);
  $st->bindParam(':idEjemplar', $idEjemplar);
  
  $exitoA = $st->execute() or die (implode ('>>', $st->errorInfo()));
  //cambia el estado de un ejemplar 1 disponible, 2 prestado, 3 en mantenimiento o 4 baja
  $query="CALL update_disponibilidadEjemplar (:idEjemplar, :estado)";
  $st = $pdo->prepare($query);
  $estado=2;
  $st->bindParam(':idEjemplar',$idEjemplar);
  $st->bindParam(':estado',$estado);
  $exitoB = $st->execute() or die (implode ('>>', $st->errorInfo()));
 if($exitoA && $exitoB){
  $pdo->commit();
  header("Location:../../vistas/biblioteca/bprincipal.php");
 }else{
  $pdo->rollback();
  exit("Se presentó un problema al guardar el préstamo, comunícate con el administrador ");
 }
}
function devolverLibro($idPrestamo, $idEjemplar, $fregreso, $observaciones){
  require '../../modelo/config/pdo.php';
  $pdo->beginTransaction();
  //se registra fecha de devolucion y observaciones en el prestamo
  $query="CALL update_devolverLibro (:fregreso, :observaciones, :idPrestamo)";
  $st = $pdo->prepare($query);
  $st->bindParam(":fregreso", $fregreso);
  $st->bindParam(':observaciones', $observaciones);
  $st->bindParam(':idPrestamo', $idPrestamo);
  
  $exitoA = $st->execute() or die (implode ('>>', $st->errorInfo()));
  //cambia el estado de un ejemplar 1 disponible,
  $query="CALL update_disponibilidadEjemplar (:idEjemplar, :estado)";
  $st = $pdo->prepare($query);
  $estado=1;
  $st->bindParam(':idEjemplar',$idEjemplar);
  $st->bindParam(':estado',$estado);
  $exitoB = $st->execute() or die (implode ('>>', $st->errorInfo()));
 if($exitoA && $exitoB){
  $pdo->commit();
  header("Location:../../vistas/biblioteca/bprincipal.php");
 }else{
  $pdo->rollback();
  exit("Se presentó un problema al devolver el libro, comunícate con el administrador ");
 }
}

//busca los ejemplares que tiene cada usuario de un titulo en especifico que esten disponibles para prestamo
//1 es disponible
function buscaEjemplares($idLibro, $idUsuario) {
  
    require '../../modelo/config/pdo.php';
    //disponible 1 habilitado 2 prestado 3 baja o mantenimiento
    $query="CALL sisantee_sics.select_buscaEjemplaresDispobibles(:idlibro, :idUsuario);";
    $st = $pdo->prepare($query);
    $st->bindParam(":idlibro", $idLibro);
  $st->bindParam(":idUsuario", $idUsuario);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $ejmplares=$st->fetchAll(PDO::FETCH_OBJ);
          return $ejmplares;
      }else{
        return false;
      
   
}
}
function buscaEjemplaresPorLibro($idLibro) {
  
  require '../../modelo/config/pdo.php';
 
  $query="CALL select_buscaEjemplaresXLibro(:idlibro);";
  $st = $pdo->prepare($query);
  $st->bindParam(":idlibro", $idLibro);

  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $ejmplares=$st->fetchAll(PDO::FETCH_OBJ);
        return $ejmplares;
    }else{
      return false;
    
 
}
}

//actualiza  el usuario que tiene la custodia
function actualizarCustodia($idejemplar, $idUsuario){
  require '../../modelo/config/pdo.php';
  $query="CALL select_actualziaCustodia (:idUsuario, :idejemplar)";
  $st = $pdo->prepare($query);
  $st->bindParam(":idUsuario", $idUsuario);
  $st->bindParam(':idejemplar', $idejemplar);
  
  
  $exitoA = $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($exitoA ){
    return true;
  }else{
    return false;
  }
}
// busca los prestamos activos por grupo
function buscaPrestamosActivosGrupo($grupo){
  
  require '../../modelo/config/pdo.php';
    $query="CALL select_buscaPrestamosGrupo(:idgrupo);";
  $st = $pdo->prepare($query);
  $st->bindParam(":idgrupo", $grupo);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }else{
      return false;
    
 
}
}
//busca estadisticas de prestamos de libros
function buscaEstadisticasPrestamos(){
  //cantidad de ejemplares prestados 
  $prestamos = buscaCuantosPrestamos();
 
  //titulos mas prestados
  $libros = buscaTodosLibros();
  foreach($libros as $l){
      $titlosMasPrestados = buscaPrestamosLibro($l->idlibros);
      $i=0;
        //se cuentan cuantos prestamos tiene el titulo
        if($titlosMasPrestados != false){
            foreach($titlosMasPrestados as $tmp){
              $i=$i+1;
            }
            $estTitulo[]=array( "prestamos"=>$i, "titulo"=>$l->titulo);
            arsort($estTitulo);
          }
  }
    //busca libros prestados por grupos
   // require '../../modelo/config/comunes.php';
    $grupos = buscarTodosGrupos();
      foreach($grupos as $g){
            $prestamoXGrupo = buscaTodosPrestamosGrupo($g->idgrupos);
            $i=0;
            if($prestamoXGrupo != false){
            foreach($prestamoXGrupo as $pg){
              $i++;
            }
          }
            $estGrupo[] = array("prestamos"=>$i, "Grupo"=>$g->grupo);
            arsort($estGrupo);
      }
    
    //buscar los prestamos totales de libros del ciclo escolar
    $totalPrestamos =buscaPrestamosTotales();
    
   
  
  
  
  //se cargan totales de las busquedas
  $estadisticas [] = array("prestados"=>$prestamos[0],"xTitulo"=>$estTitulo, "xGrupo"=>$estGrupo,"Total"=>$totalPrestamos);
  return $estadisticas;
}
//busca cuantos libros hay prestados para la estadisticas
function buscaCuantosPrestamos(){
  require '../../modelo/config/pdo.php';
    $query="SELECT count(idPrestamos) as prestados 
    FROM prestamos join estudiantes 
    on estudiantes_idestudiantes = idestudiantes 
    join ejemplar on idEjemplar=ejemplar_idEjemplar 
    WHERE disponible= :prestados";
  $st = $pdo->prepare($query); 
  $prestados=2;
  $st->bindParam(":prestados",$prestados);
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $cuantos=$st->fetchAll(PDO::FETCH_OBJ);
        return $cuantos;
    }else{
      return false;

}
}
function buscaPrestamosTotales(){
  require '../../modelo/config/pdo.php';
    $query="SELECT count(idPrestamos) as prestados 
    FROM prestamos join estudiantes 
    on estudiantes_idestudiantes = idestudiantes 
    join ejemplar on idEjemplar=ejemplar_idEjemplar";
  $st = $pdo->prepare($query); 
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $cuantos=$st->fetchAll(PDO::FETCH_OBJ);
        return $cuantos;
    }else{
      return false;

}
}
//buscar grupos
function buscarTodosGrupos(){
  require '../../modelo/config/pdo.php';
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
//busca los idlibro por titulo
function buscaLibroXTitulo($libro){
  
  require '../../modelo/config/pdo.php';
    $query="SELECt idlibros FROM libros where titulo = :libro";
  $st = $pdo->prepare($query);
  $st->bindParam(":libro", $libro);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $idlibro=$st->fetchAll(PDO::FETCH_OBJ);
        return $idlibro;
    }else{
      return false;
    
 
}
}
//busca todos los prestamos activos e inactivos por grupo
function buscaTodosPrestamosGrupo($grupo){
$prestamos = array();
  $activos = buscaPrestamosActivosGrupo($grupo);
  $noactivos = buscaPrestamosNoActivosGrupo($grupo);
  $i=0;
  if($activos !=false){

foreach($activos as $a){
$prestamos[$i]= ($a);
$i++;
}
  }
  if($noactivos !=false){

    foreach($noactivos as $na){
    $prestamos[$i]= ($na);
    $i++;
    }
      }


return $prestamos;
}
// busca los prestamos no activos por grupo
function buscaPrestamosNoActivosGrupo($grupo){
  
  require '../../modelo/config/pdo.php';
    $query="CALL selec_buscaPrestamoGrupoNoActivos(:idgrupo)";
  $st = $pdo->prepare($query);
  $st->bindParam(":idgrupo", $grupo);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }else{
      return false;
    
 
}
}
// busca los prestamos activos por grupo
function buscaPrestamosAlumno($idal){
  
  require '../../modelo/config/pdo.php';
    $query="CALL select_buscaPrestamosAlumno(:idal);";
  $st = $pdo->prepare($query);
  $st->bindParam(":idal", $idal);
  
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }else{
      return false;
    
 
}
}
//busca los prestasmos de libros por idLibro
function buscaPrestamosLibro($libro){
  require '../../modelo/config/pdo.php';
  $query="CALL select_librosPrestadosIdLibros (:idlibro);";
  $st = $pdo->prepare($query);
  $st->bindParam(":idlibro", $libro);

  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }else{
      return false;
   }
}
function guardarEditorial($editorial ){
  require '../../modelo/config/pdo.php';
  
  $query="INSERT INTO editorial (editorial)VALUES (:editorial)";
  $st = $pdo->prepare($query);
  $st->bindParam(":editorial", $editorial);

  
  $d = $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($d){
    return true;
  }else{
    return false;
  }
}
function agregaNuevoEjemplar($ejemplar, $f_alta, $procedencia, $idlibro, $custodiaNejemplar){
  require '../../modelo/config/pdo.php';
 
  $query="CALL `insert_nuevoEjemplar` (:ejemplar,  :fechaAlta, :procedencia, :idlibro, :idusuario)";
  $st = $pdo->prepare($query);
  $st->bindParam(":ejemplar", $ejemplar);
  $st->bindParam(':fechaAlta', $f_alta);
  $st->bindParam(':procedencia', $procedencia);
  $st->bindParam(':idlibro', $idlibro);
  $st->bindParam(':idusuario', $custodiaNejemplar);
  
  $exitoA = $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($exitoA){
    return true;
  }else{
    return false;
  }
}
function buscaProcedencia(){
  require '../../modelo/config/pdo.php';
  $query="CALL select_buscaProcedencia()";
  $st = $pdo->prepare($query);
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
    $procedencia=$st->fetchAll(PDO::FETCH_OBJ);
        return $procedencia;
  }else{
    return false;
  }
}
function buscaBibliotecarios(){
  require '../../modelo/config/pdo.php';
  $query="CALL select_buscaBibliotecarios();";
  $st = $pdo->prepare($query);
  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
    $bibliotecarios=$st->fetchAll(PDO::FETCH_OBJ);
        return $bibliotecarios;
  }else{
    return false;
  }
}
// busca los prestamo por folio
function buscaPrestamo($idPrestamo){
  require '../../modelo/config/pdo.php';
  $query="CALL sisantee_sics.select_buscaPrestamo(:idPrestamo);";
  $st = $pdo->prepare($query);
  $st->bindParam(":idPrestamo", $idPrestamo);

  $st->execute() or die (implode ('>>', $st->errorInfo()));
  if($st->rowCount()>0){
      $prestamos=$st->fetchAll(PDO::FETCH_OBJ);
        return $prestamos;
    }else{
      return false;
   }
 
}
?>