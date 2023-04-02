<?php

  function cargaMotivosPsico(){
    require '../../modelo/config/pdo.php';
      $query ="CALL select_BuscaMotivosPsicologia";
      $st = $pdo->prepare($query);
      
    
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $categorias=$st->fetchAll(PDO::FETCH_OBJ);
            return $categorias;
        }else{
          return false;
       }
  }
  function get_BuscaEstadisticasPsico($fecha){
    require '../../modelo/config/pdo.php';
    //se buscan los atendidos
    $query ="SELECT count(idatencion_psico) as atendidos FROM sisantee_sics.atencion_psico;";
    $st = $pdo->prepare($query); 
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $atendidos=$st->fetchAll(PDO::FETCH_OBJ);
        
      }else{
        $atendidos = "";
     }
     //se buscan los activos 
     $query2 ="Select count(idatencion_psico) as seguimiento from atencion_psico where darSeguimiento = 1;";
     $st2 = $pdo->prepare($query2); 
     $st2->execute() or die (implode ('>>', $st2->errorInfo()));
     if($st2->rowCount()>0){
      $seguimiento=$st2->fetchAll(PDO::FETCH_OBJ);
     }else{
      $seguimiento ="";
     }
     //se buscan cerrados
     $query3="Select count(idatencion_psico) as cerrados from atencion_psico where darSeguimiento = 0;";
     $st3 = $pdo->prepare($query3); 
     $st3->execute() or die (implode ('>>', $st3->errorInfo()));
     if($st3->rowCount()>0){
      $cerrados=$st3->fetchAll(PDO::FETCH_OBJ);
     }else{
      $cerrados ="";
     }
     //se buscan los del dia
     $query4 ="Select count(idatencion_psico) as hoy from atencion_psico where fecha  = :fecha;";
     $st4 = $pdo->prepare($query4);
     $st4->bindParam(':fecha',$fecha);
     $st4->execute() or die (implode ('>>', $st4->errorInfo()));

     if($st4->rowCount()>0){
      $porfecha=$st4->fetchAll(PDO::FETCH_OBJ);
     }else{
      $porfecha ="";
     }
     //busqueda de motivos 
     $query5="SELECT motivo, COUNT(*) as cantidadMotivo FROM sisantee_sics.atencion_psico  GROUP BY motivo ORDER BY cantidadMotivo DESC";
     $st5 = $pdo->prepare($query5); 
     $st5->execute() or die (implode ('>>', $st5->errorInfo()));
     if($st5->rowCount()>0){
      $motivos=$st5->fetchAll(PDO::FETCH_OBJ);
     }else{
      $motivos ="";
     }
     //busqueda de grupos
     $query6="SELECT grupo, COUNT(*) as cantidad FROM sisantee_sics.atencion_psico join estudiantes 
     on idestudiantes =estudiantes_idestudiantes join grupos on idgrupos = grupos_idgrupos GROUP BY grupo  
     ORDER BY cantidad DESC;";
     $st6 = $pdo->prepare($query6); 
     $st6->execute() or die (implode ('>>', $st6->errorInfo()));
     if($st6->rowCount()>0){
      $grupos=$st6->fetchAll(PDO::FETCH_OBJ);
     }else{
      $grupos ="";
     }
     //busqueda de categoria
      
      $query7="SELECT categoria_psico, COUNT(*) as cantidad FROM sisantee_sics.atencion_psico  
      join categoria on idcategoria_psico = categoria_idcategoria_psico
     GROUP BY categoria_psico ORDER BY cantidad DESC";
      $st7 = $pdo->prepare($query7); 
      $st7->execute() or die (implode ('>>', $st7->errorInfo()));
      if($st6->rowCount()>0){
       $categoria=$st7->fetchAll(PDO::FETCH_OBJ);
      }else{
       $categoria ="";
      }
 
      $datos = array("atendidos"=>$atendidos, "seguimiento"=>$seguimiento, "cerrados" =>$cerrados, 
      "hoy"=>$porfecha,"motivos"=>$motivos, "grupos"=>$grupos,"categoria"=>$categoria);
      return $datos;
  }
  function cargaMotivosNotificacion(){
    require '../../modelo/config/pdo.php';
    $query ="CALL select_buscaMotivoNotificaciones()";
    $st = $pdo->prepare($query);
    
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $motivos=$st->fetchAll(PDO::FETCH_OBJ);
          return $motivos;
      }else{
        return false;
     }
    
  }

  function buscarNotificaciones($folio){
    require '../../modelo/config/pdo.php';
    $query ="CALL select_buscaNotificacionesPsico (:id)";
    $st = $pdo->prepare($query);
    $st->bindparam(':id',$folio);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $datos=$st->fetchAll(PDO::FETCH_OBJ);
          return $datos;
      }else{
        return false;
     }

  }
  function cargaPendientesPsico(){
    require '../../modelo/config/pdo.php';
    $query ="CALL select_buscaPendientesPsico()";
    $st = $pdo->prepare($query);
    
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $pendientes=$st->fetchAll(PDO::FETCH_OBJ);
          return $pendientes;
      }else{
        return false;
     }
  }
  function cargaCategoriasPsico(){
    require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaCategoriasPsico()";
      $st = $pdo->prepare($query);
      
    
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $categorias=$st->fetchAll(PDO::FETCH_OBJ);
            return $categorias;
        }else{
          return false;
       }
     
    }
    function buscaCasoPsico($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaAtencionPsico (:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $datos=$st->fetchAll(PDO::FETCH_OBJ);
            return $datos;
        }else{
          return false;
       }
    }
    function buscaSuspensiones($id){

      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaSuspensiones(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $suspensiones=$st->fetchAll(PDO::FETCH_OBJ);
            return $suspensiones;
        }else{
          return false;
       }
    }
    function buscaCategoCanalPsico(){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaCatCanalPsico()";
      $st = $pdo->prepare($query);
      
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $especialistasPsico=$st->fetchAll(PDO::FETCH_OBJ);
            return $especialistasPsico;
        }else{
          return false;
       }
    }
    function buscaEspecialistas(){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaEspecialistaPsico()";
      $st = $pdo->prepare($query);
      
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $especialistasPsico=$st->fetchAll(PDO::FETCH_OBJ);
            return $especialistasPsico;
        }else{
          return false;
       }
    }
    function buscaCasosPisoXAlumno($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL  select_buscaCasosPsicoxAlumno(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $casos=$st->fetchAll(PDO::FETCH_OBJ);
            return $casos;
        }else{
          return false;
       }
     
    }
    function buscaCanalizacionesPsico($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaCanalizacionPsico(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $canalicaiones=$st->fetchAll(PDO::FETCH_OBJ);
            return $canalicaiones;
        }else{
          return false;
       }
    }
    function buscaSeguimientos($id){

      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaSeguimientoCaso(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $seguimientos=$st->fetchAll(PDO::FETCH_OBJ);
            return $seguimientos;
        }else{
          return false;
       }
    }
    function actualizaAsuntoPsico($fecha, $motivo, $descripcion, $folio){
      require '../../modelo/config/pdo.php';
      $sql = "CALL insert_actCasoPsico(:motivo,:desc, :fecha, :folio)";
        $st = $pdo->prepare($sql);
        $st->bindparam(':motivo',$motivo);  
        $st->bindparam(':desc',$descripcion);
        $st->bindparam(':fecha',$fecha);  
        $st->bindparam(':folio',$folio);
        $st->execute() or die (implode ('>>', $st->errorInfo()));
        if($st->rowCount()>0){
 
              return true;
          }else{
            return false;
         }
    }
    function actualizaSeguimiento($estado, $folio){
      require '../../modelo/config/pdo.php';
      $sql = "UPDATE `sisantee_sics`.`atencion_psico` SET `darSeguimiento` = :estado WHERE (`idatencion_psico` = :id);";
        $st = $pdo->prepare($query);
        $st->bindparam(':estado',$estado);  
        $st->bindparam(':id',$folio);
        $st->execute() or die (implode ('>>', $st->errorInfo()));
        if($st->rowCount()>0){
 
              return true;
          }else{
            return false;
         }
       
      }

      function guardaNuevoEspecialistaPsicologico($especialista){
        require '../../modelo/config/pdo.php';
        $query= "call insert_guardaEspecialistaCanalPsico(:especialista)";
        $st= $pdo->prepare($query);
        $st->bindParam(':especialista',$especialista);
       
  
        $st->execute() or die (implode( " >> ", $st->errorInfo()));
        if($st->rowCount()>0){
         
            return $query;
        }else{
          return false;
        
         }
      }
      function guardaNuevoCategoriaCanalizaPsicologico($categoria){
        require '../../modelo/config/pdo.php';
        $query= "call insert_guardaCategoriaCanalPsico(:categoria)";
        $st= $pdo->prepare($query);
        $st->bindParam(':categoria',$categoria);
       
  
        $st->execute() or die (implode( " >> ", $st->errorInfo()));
        if($st->rowCount()>0){
         
            return $query;
        }else{
          return false;
        
         }
      }
      function guardaNuevaCanalizacionPsico($fecha, $descripcion, $folio, $especialista, $categoria){
        require '../../modelo/config/pdo.php';
        $query= "call insert_guardaNuevaCanalizacionPsico(:fecha,:descripcion, :folio, :idEsp, :idCat)";
        $st= $pdo->prepare($query);
        $st->bindParam(':fecha',$fecha);
        $st->bindParam(':descripcion',$descripcion);
        $st->bindParam(':folio',$folio);
        $st->bindParam(':idEsp',$especialista);
        $st->bindParam(':idCat',$categoria);
  
        $st->execute() or die (implode( " >> ", $st->errorInfo()));
        if($st->rowCount()>0){
         
            return $query;
        }else{
          return false;
        
     }

      }
      function insertaCitatorioPsico($descripcion, $fecha,  $fechaCitatorio,  $viaComunicacion, $folio ){
        require '../../modelo/config/pdo.php';
      $query= "call sisantee_sics.insert_guardaCitatorio(:desc,:fecha, :fechaCita, :via, :folio)";
      $st= $pdo->prepare($query);
      $st->bindParam(':desc',$descripcion);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':fechaCita',$fechaCitatorio);
      $st->bindParam(':via',$viaComunicacion);
      $st->bindParam(':folio',$folio);

      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return $query;
      }else{
        return false;
      
   }
      }

    function insertanuevoPiscoAtencion ($fecha, $motivo, $categoria, $descripcion, $darSeguimiento, $alumno){
      require '../../modelo/config/pdo.php';
      $query= "INSERT INTO `sisantee_sics`.`atencion_psico` (`motivo`, `descripcion`, `fecha`, `darSeguimiento`, `estudiantes_idestudiantes`, `categoria_idcategoria_psico`) 
      VALUES (:motivo, :descripcion, :fecha, :darSeguimiento, :estudiantes_idestudiantes, :categoria_idcategoria_psico);";
      $st= $pdo->prepare($query);
      $st->bindParam(':motivo',$motivo);
      $st->bindParam(':descripcion',$descripcion);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':darSeguimiento',$darSeguimiento);
      $st->bindParam(':estudiantes_idestudiantes',$alumno);
      $st->bindParam(':categoria_idcategoria_psico',$categoria);
      
     
      
      
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return $query;
      }else{
        return false;
      
   }
    }

    function insertaMotivoPsico($motivo){
      require '../../modelo/config/pdo.php';
      $query= "INSERT INTO `sisantee_sics`.`motivoPsico` (`motivoPsico`) VALUES (:motivo);";
      $st= $pdo->prepare($query);
      $st->bindParam(':motivo',$motivo);
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
    }
    function guardaNuevoMedio($motivo){
      require '../../modelo/config/pdo.php';
      $query= "CALL insert_nuevoMedioComunicacion(:motivo)";
      $st= $pdo->prepare($query);
      $st->bindParam(':motivo',$motivo);
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
    }
    function insertaCategoriaPsico($cate){
      require '../../modelo/config/pdo.php';
      $query= "CALL insert_Categoria_Psico(:categoria)";
      $st= $pdo->prepare($query);
      $st->bindParam(':categoria',$cate);
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
    }
    function insertaSuspension($fecha, $fechaInicial, $fechaFinal, $descripcion, $viaComunicacion, $folio){
      require '../../modelo/config/pdo.php';
      $query= "CALL `insert_guardaSuspension`(:fecha,:finicial,:ffinal,:sus,:via,:folio)";
      $st= $pdo->prepare($query);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':finicial',$fechaInicial);
      $st->bindParam(':ffinal',$fechaFinal);
      $st->bindParam(':sus',$descripcion);
      $st->bindParam(':via',$viaComunicacion);
      $st->bindParam(':folio',$folio);
      
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
    }
    function insertaNuevaNotificacion($fecha, $descripcion, $motivo, $folio){
      require '../../modelo/config/pdo.php';
      $query= "CALL insert_nuevaNotificacion(:fecha,:desc,:motivo,:folio)";
      $st= $pdo->prepare($query);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':desc',$descripcion);
      $st->bindParam(':motivo',$motivo);
      $st->bindParam(':folio',$folio);
      
      $st->execute() or die (implode( " >> ", $st->errorInfo()));
      if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
    }
    function buscaCitatorios($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaCitatorioPsico(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $citatorios=$st->fetchAll(PDO::FETCH_OBJ);
            return $citatorios;
        }else{
          return false;
       }
    }
    function buscaEvidenciasPsico($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaEvidenciasPsico(:id)";
      $st = $pdo->prepare($query);
      $st->bindparam(':id',$id);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $evidencias=$st->fetchAll(PDO::FETCH_OBJ);
            return $evidencias;
        }else{
          return false;
       }
    }
    function insertaEvidenciaPsico($titulo, $imagen,$tipo, $id){
      require '../../modelo/config/pdo.php';

$query ="CALL insert_guardaEvidenciaPsico (:titulo, :imagen,:tipo, :id)";
$st = $pdo->prepare($query);
$st->bindParam(':titulo',$titulo);
$st->bindParam(':imagen',$imagen);
$st->bindParam(':tipo',$tipo);
$st->bindParam(':id',$id);
$res = $st->execute() or die (implode(">>", $st->errorInfo()));
if($res){
return true;
}else{
return false;
}
    }
    
?>