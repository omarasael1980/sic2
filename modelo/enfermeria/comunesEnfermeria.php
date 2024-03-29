<?php
  
  function insertaSeguroEscolar($fecha, $descripcion,$causa, $medidas, $monto, $terceros, $idenfermeria, $idusuario, $acta, $autoridad){
    require '../../modelo/config/pdo.php';
      $query ="CALL insert_seguroEscolar(:fecha, :descripcion, :causa,:medidas,:monto, :terceros, :idenfermeria, :idusuario)";
      
      $st = $pdo->prepare($query);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':descripcion',$descripcion);
      $st->bindParam(':causa',$causa);
      $st->bindParam(':medidas',$medidas);
      $st->bindParam(':monto',$monto);
      $st->bindParam(':terceros',$terceros);
      $st->bindParam(':idenfermeria',$idenfermeria);
      $st->bindParam(':idusuario',$idusuario);
      
        $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
        $mex=$st->fetchAll(PDO::FETCH_ASSOC);
       
          return true;
         
      }else{
        return false;
      
   }
     

      
     
    }
   function actualizaMontoSE($monto, $folio){
    require '../../modelo/config/pdo.php';
      $query= "CALL  update_ActualizaMontoSeguroEscolar(:monto, :folio)";
      $st = $pdo->prepare($query);
      $st->bindParam(':monto',$monto);
      $st->bindParam(':folio',$folio);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          
            return true;
        }else{
          return false;
        
    }
   }
    
 
   function atencionesxCategoria(){
    $query ="CALL select_estadisticaCategoriaMedica()";
    require '../../modelo/config/pdo.php';
   
    $st = $pdo->prepare($query);
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $cantidad=$st->fetchAll(PDO::FETCH_OBJ);
          return $cantidad;
      }else{
        return false;
      
   }
   }
   function buscaCantidadGastada(){
    $query ="CALL select_cantidadGastada() ";
    require '../../modelo/config/pdo.php';
   
    $st = $pdo->prepare($query);
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $cantidad=$st->fetchAll(PDO::FETCH_OBJ);
          return $cantidad;
      }else{
        return false;
      
   }
   }
   //busca el expediente del alumno para ver historia clinica
   function buscaExpedienteMedico($id){
    require '../../modelo/config/pdo.php';
    $query ="CALL select_buscaExpedienteMedico(:idalumno)";
    $st = $pdo->prepare($query);
    $st->bindparam('idalumno',$id);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $expediente=$st->fetchAll(PDO::FETCH_OBJ);
          return $expediente;
      }else{
        return false;
      
   }
   }
   function buscaTodasEnfermedades(){
    $query ="CALL select_buscaEnfermedadesCronicas()";
    require '../../modelo/config/pdo.php';
    $st = $pdo->prepare($query);
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $enfermedades=$st->fetchAll(PDO::FETCH_OBJ);
          return $enfermedades;
      }else{
        return false;
      
   }
   }
   function crearExpedienteMedico($alergias, $enfermedades, $medicacion,$estado,  $id){
    require '../../modelo/config/pdo.php';
    $query= "CALL  insert_nuevoExpedienteMedico(:alergias, :enfermedades, 
    :medicacion,:estado, :id);";
    $st = $pdo->prepare($query);
    $st->bindParam(':alergias',$alergias);
    $st->bindParam(':enfermedades',$enfermedades);
    $st->bindParam(':medicacion',$medicacion);
    $st->bindParam(':estado',$estado);
    $st->bindParam(':id',$id);
   
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        
          return true;
      }else{
        return false;
      
  }
   }
   function actualizaExpedienteMedico($alergias, $enfermedades, $medicacion, $folio){
    require '../../modelo/config/pdo.php';
    $query= "CALL  update_actualizaExpedienteMedico (:alergias, :enfermedades, 
    :medicacion, :folio);";
    $st = $pdo->prepare($query);
    $st->bindParam(':alergias',$alergias);
    $st->bindParam(':enfermedades',$enfermedades);
    $st->bindParam(':medicacion',$medicacion);
    $st->bindParam(':folio',$folio);
   
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        
          return true;
      }else{
        return false;
      
  }
   }
   function actualizaEnfermedadesCronicas($enfermedades, $id){
    require '../../modelo/config/pdo.php';
    $query= "CALL  update_actualizaEnfermedades(:enfermedades, :id)";
    $st = $pdo->prepare($query);
    $st->bindParam(':enfermedades',$enfermedades);
    $st->bindParam(':id',$id);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        
          return true;
      }else{
        return false;
      
  }
   }
   function guardaNuevasEnfermedades($enfermedad){
    $query = "CALL insert_guardaEnfermedades(:enfermedad);";
    require '../../modelo/config/pdo.php';
    
    $st = $pdo->prepare($query);
    $st->bindParam(':enfermedad',$enfermedad);
   
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        
          return true;
      }else{
        return false;
      
  }
   }
   function buscaTodaslasAlergias(){
    $query = "CALL select_buscaTodasAlergia();";
    require '../../modelo/config/pdo.php';
    $st = $pdo->prepare($query);
  
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $alergias=$st->fetchAll(PDO::FETCH_OBJ);
          return $alergias;
      }else{
        return false;
      
   }
   }
   function insertaExpedienteMedico($alergia, $enfermedades, $med, $estado, $alumno){
    require '../../modelo/config/pdo.php';
    $query ="CALL insert_guardaExpedienteMedico (:alergia,:enfermedades,:med,:estado,:idalumno);";
    $st = $pdo->prepare($query);
    $st->bindParam(':alergia',$alergia);
    $st->bindParam(':enfermedades',$enfermedades);
    $st->bindParam(':med',$med);
    $st->bindParam(':estado',$estado);
    $st->bindParam(':alumno',$alumno);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        return true;
      }else{
        return false;
      
   }
   }

    function insertarAutoridadesContactadas($pdo,$autoridad, $folio, $idSeguroEscolar){
      
        $query ="CALL insert_ingresaAutoridad`(:acta, :autoridad, :idSeguridadEscolar);";
        
        $st = $pdo->prepare($query);
        $st->execute() or die (implode ('>>', $st->errorInfo()));
        if($st->rowCount()>0){
            $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
              return $ucasos;
          }else{
            return false;
          
       }
      }
function cargarUltimasAtencionesMedicas(){
  require '../../modelo/config/pdo.php';
    $query ="CALL select_ultimosCasosEnfermeria";
    $st = $pdo->prepare($query);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
        $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
          return $ucasos;
      }else{
        return false;
      
   }
  }

  function inserta_canalizacionMedica($fecha, $desc, $idenfermeria, $idespecialista){
    require '../../modelo/config/pdo.php';
    $query="CALL insert_agregarCanalizacionMedica(:fecha,:desc, :idEnfermeria, :idespecialista );";
    $st = $pdo->prepare($query);
    $st->bindParam(':fecha',$fecha);
    $st->bindParam(':desc',$desc);
    $st->bindParam(':idEnfermeria',$idenfermeria);
    $st->bindParam(':idespecialista',$idespecialista);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    if($st->rowCount()>0){
       
          return true;
      }else{
        return false;
      
   }
  }
  function buscaEspecialista(){
    require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaEspecialista();";
      $st = $pdo->prepare($query);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $especialistas=$st->fetchAll(PDO::FETCH_OBJ);
            return $especialistas;
        }else{
          return false;
        
     }
    }
  function dameEstadisticasMedicas($fechaI, $fechaF){
    require '../../modelo/config/pdo.php';
   
      $categorias =getCategoriasMedicas();
      //se prepara el array para almacenar resultados por categorias
      $ec = array();
      //Se buscan las estadisticas por categorias
              foreach($categorias as $cat)
            {
              $id =$cat->idcategoria_medica;
              $query="CALL select_buscaEstadisticasCategoriaMedica(:id, :fechaI, :fechaF)";
              $st = $pdo->prepare($query);
              $st->bindParam(':id',$id);
              $st->bindParam(":fechaI",$fechaI);
              $st->bindParam(":fechaF",$fechaF);
              $st->execute() or die (implode(">>", $st->errorInfo()));
                  if($st->rowCount()>0){
                    while($row = $st->fetch(PDO::FETCH_ASSOC)){
                    $ec[]= array( 'numero'=>$row['cantidad'], 'categoria'=>$cat->categoriaMedica);

                    } 
                    }else {
                      $ec[]=array('numero'=>0, 'categoria'=>0);
      
              }
      
        }
        //se buscan estadisticas por grupo
       
        $query = "CALL select_buscaGrupo();";
        $st= $pdo->prepare($query);
        $st->execute() or die (implode(">>", $st->errorInfo()));
        if($st->rowCount()>0){
          $grupos = $st->fetchALL(PDO::FETCH_OBJ);
          
        }
       
        foreach($grupos as $gr){
          $idgrupos =$gr->idgrupos;
          $query="CALL select_buscaEstadisticaMedicaGrupo (:idGrupo, :fechaI, :fechaF)";
          $st = $pdo->prepare($query);
          $st->bindParam(':idGrupo',$idgrupos);
          $st->bindParam(":fechaI",$fechaI);
          $st->bindParam(":fechaF",$fechaF);
          $st->execute() or die (implode(">>", $st->errorInfo()));
              if($st->rowCount()>0){
                while($row = $st->fetch(PDO::FETCH_ASSOC)){
                $eg[]= array( 'numero'=>$row['valor'], 'grupo'=>$gr->grupo);
                
                }
                }else{
                  $eg[]=array('cantidad'=>0);
  
          }

        }
        //se buscan los incidentes medicos por fecha
        $query ="CALL select_buscaCuantasIncidenciasMedicas(:fechaI, :fechaF)";
        $st = $pdo->prepare($query);
        
          $st->bindParam(":fechaI",$fechaI);
          $st->bindParam(":fechaF",$fechaF);
          $st->execute() or die (implode(">>", $st->errorInfo()));
              if($st->rowCount()>0){
                $estIncidencias []=array('cantidad'=>$st->fetch(PDO::FETCH_ASSOC));
              }else{
                $estIncidencias []=array('cantidad'=>0, 'Incidencias'=>'Incidencias');
              }
        // se buscan los incidentes dias sin incidentes medicos
        $query ="CALL select_buscaFechaUltimoIncMedico";
        $st = $pdo->prepare($query);
        $st->execute() or die (implode(">>", $st->errorInfo()));
            if($st->rowCount()>0){
              $ultimoEvento []=array('fecha'=>$st->fetch(PDO::FETCH_ASSOC));
              $fechita =   $ultimoEvento[0]['fecha'];
              $ultimoIncifente = $fechita['fecha'];
              $ultimoIncifente =substr($ultimoIncifente,0,-9);
              date_default_timezone_set("America/Tijuana");
             $hoy = getdate();
             $hoy = date("Y-m-d"); 
             //se restan los dias
             $diferencia = dias_pasados($hoy,$ultimoIncifente);
            }else{
              $ultimoEvento []=array('fecha'=>"" );
              $diferencia ="";
            }
            
       
        //se ordena el array
        arsort($ec);
       arsort($eg);
        //juntar resultados
        $estadisticas = array();
        $estadisticas [] = array('Categorias'=>$ec, "Grupos"=>$eg, "Incidencias"=>$estIncidencias, "ultimoEvento"=>$diferencia);
        return $estadisticas ;
  }

  function dias_pasados($fecha_inicial,$fecha_final)
  {
  $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
  $dias = abs($dias); 
  $dias = floor($dias);
  return $dias;
  }
   function cargarAtencionesMedicasAlumno($id){
    require '../../modelo/config/pdo.php';
    $query ="CALL select_cargaAtencionMedAlumno(:idalumno)";
    $st = $pdo->prepare($query);
    $st->bindParam(':idalumno',$id);
    $st->execute() or die (implode ('>>', $st->errorInfo()));
    $i=0;
    if($st->rowCount()>0){

        $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
       
      }else{
        return false;
         }
         $i=0;
         $res =array();
         foreach($ucasos as $u){
          //se adjuntan las actualizaciones medicas
         $act= buscaActualizacionesMedicas($u->idenfermeria);
        $ev= getEvidenciasMed($u->idenfermeria);
        $se = getSeguroEscolar($u->idenfermeria);
        $can = getCanalizacionesMedicas($u->idenfermeria);
          $res[$i]=array ('cas'=>$u, 'ac'=>$act, 'ev'=>$ev, 'seguros'=>$se, 'Canalizacion'=>$can);
          
         
          //se adjuntan las evidencias
          //se adjuntan las canalizaciones 

          $i++;

         }
         return $res;
    }
    function getCanalizacionesMedicas($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaCanalizacionesMedicas(:id)";
      
      $st = $pdo->prepare($query);
      $st->bindParam(':id',$id);
      $st->execute() or die(implode('>>',$st->errorInfo()));
      if($st->rowCount()>0){
       
        $canalizado=$st->fetchAll(PDO::FETCH_OBJ);
        
        return $canalizado;
       }else{

         return false;
          }
    }
    function getSeguroEscolarxFolio($folio){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaSeguroEscolarxFolio(:id)";
      
      $st = $pdo->prepare($query);
      $st->bindParam(':id',$folio);
      $st->execute() or die(implode('>>',$st->errorInfo()));
      if($st->rowCount()>0){
       
        $seguros=$st->fetchAll(PDO::FETCH_OBJ);
        
        return $seguros;
       }else{

         return false;
          }
    }
    function getSeguroEscolar($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaSeguroEscolar(:id)";
      
      $st = $pdo->prepare($query);
      $st->bindParam(':id',$id);
      $st->execute() or die(implode('>>',$st->errorInfo()));
      if($st->rowCount()>0){
       
        $seguros=$st->fetchAll(PDO::FETCH_OBJ);
        
        return $seguros;
       }else{

         return false;
          }
    }
    function getEvidenciasMed($id){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_buscaEvidenciasMedicas(:id)";
      
      $st = $pdo->prepare($query);
      $st->bindParam(':id',$id);
      $st->execute() or die(implode('>>',$st->errorInfo()));
      if($st->rowCount()>0){
       
        $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
        
        return $ucasos;
       }else{

         return false;
          }
    }
    function getCategoriasMedicas(){
      require '../../modelo/config/pdo.php';
      $query ="CALL select_categoriasMedicas()";
      $st = $pdo->prepare($query);
     
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
          $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
            return $ucasos;
        }else{
          return false;
           }
      }

    function insertaAtencionMedica($motivo, $descripcion, $fecha, $idal, $iduser, $idcat){
      require '../../modelo/config/pdo.php';
      $query ="CALL insert_atencionMedica(:motivo, :descripcion, :fecha, :idalumno, :idusuario, :categoria)";
      $st = $pdo->prepare($query);
      $st->bindParam(':motivo',$motivo);
      $st->bindParam(':descripcion',$descripcion);
      $st->bindParam(':fecha',$fecha);
      $st->bindParam(':idalumno',$idal);
      $st->bindParam(':idusuario',$iduser);
      $st->bindParam(':categoria',$idcat);
      $st->execute() or die (implode ('>>', $st->errorInfo()));
      if($st->rowCount()>0){
         return true;
            
        }else{
          return false;
           }
      }
      function buscaAtencionMedicaporId($id){
        require '../../modelo/config/pdo.php';
        $query ="CALL select_casoEnfermeriaporId(:id)";
        
        $st = $pdo->prepare($query);
        $st->bindParam(':id',$id);
        $st->execute() or die(implode('>>',$st->errorInfo()));
        if($st->rowCount()>0){
         
          $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
          return $ucasos;
         }else{

           return false;
            }
  
      }
      function borrarCasoMedico($id){
        require '../../modelo/config/pdo.php';
        $query ="CALL delete_EliminarCasoMedico(:id)";
        
        $st = $pdo->prepare($query);
        $st->bindParam(':id',$id);
        $st->execute() or die(implode('>>',$st->errorInfo()));
        if($st->rowCount()>0){
          return true;
         }else{

           return false;
            }
  
      }
      function borrarEvidenciaMedico($id){
        require '../../modelo/config/pdo.php';
        $query ="CALL delete_EvidenciaMedica(:id)";
        
        $st = $pdo->prepare($query);
        $st->bindParam(':id',$id);
        $st->execute() or die(implode('>>',$st->errorInfo()));
        if($st->rowCount()>0){
          return true;
         }else{

           return false;
            }
  
      }
      function buscaActualizacionesMedicas($id){
        require '../../modelo/config/pdo.php';
        $query ="CALL select_buscaSeguimientoMedico(:id)";
        
        $st = $pdo->prepare($query);
        $st->bindParam(':id',$id);
        $st->execute() or die(implode('>>',$st->errorInfo()));
        if($st->rowCount()>0){
         
          $ucasos=$st->fetchAll(PDO::FETCH_OBJ);
          
          return $ucasos;
         }else{

           return false;
            }
         
      
      }
      function insertaSeguimientoMedico($motivo, $descripcion, $date, $id ){
        require '../../modelo/config/pdo.php';
        $query ="CALL inserta_seguimientoMedico(:fecha,:motivo, :descripcion,  :idenfermeria )";
        $st = $pdo->prepare($query);
        $st->bindParam(':motivo',$motivo);
        $st->bindParam(':descripcion',$descripcion);
        $st->bindParam(':fecha',$date);
        $st->bindParam(':idenfermeria',$id);
       
       
        $st->execute() or die (implode ('>>', $st->errorInfo()));
        if($st->rowCount()>0){
           return true;
              
          }else{
            return false;
             }
      }
      function insertaEvidenciaMedica($titulo, $imagen,$tipo, $id){
        require '../../modelo/config/pdo.php';

$query ="CALL insert_evidenciaMedica2(:titulo, :imagen,:tipo, :id)";
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