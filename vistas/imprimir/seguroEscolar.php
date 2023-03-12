<?php
include '../../modelo/usuarios/usuarios.php';
abreSesion();
if(!isset($_SESSION['user'])){
    header("Location:../../");
}

require('../../librerias/fpdf/fpdf.php');
require_once '../../modelo/enfermeria/comunesEnfermeria.php';
require '../../modelo/config/comunes.php';

$casos =cargarAtencionesMedicasAlumno(66);
date_default_timezone_set("America/Tijuana");
setlocale(LC_ALL, 'es_ES');
$mes =date("m");
switch($mes){
    case '01':
        $meses = "Enero";
        break;
    case '02':
        $meses = "Febrero";
        break;
    case '03':
        $meses = "Marzo";
        break;
    case '04':
        $meses = "Abril";
        break;
     case '05':
            $meses = "Mayo";
            break;
     case '06':
            $meses = "Junio";
            break;
    case '07':
            $meses = "Julio";
            break;
    case '08':
            $meses = "Agosto";
            break;
       case '09':
                $meses = "Septiembre";
                break;
    case '10':
                $meses = "Octubre";
                break;
   case '11':
                $meses = "Noviembre";
                break;
   case '12':
                $meses = "Diciembre";
                break;
}
$dia = date("d");
$anio = date("Y");
$poliza="07000030";
$empresa = "Colegio Santee A.C.";
$domicilio ="Rio Champotón S/N, Fraccionamiento Villa Florida,  Mexicali, Baja California.";
$contacto ="686-580-74-24";



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../img/empresarial/logoSantee.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'Reporte de seguro escolar',0,0,'C');
    // Salto de línea
    $this->Ln(30);
}

// Pie de página
function Footer()
{
    // Logo
    $this->Image('../../img/empresarial/logoSantee.png',30,240,33);
      // Logo
      $this->Image('../../img/empresarial/logoSantee.png',90,240,33);
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('Mexicali, B.C. a '.$dia." de ".$meses." de ".$anio),0,1,"R");
$pdf->Line (10,  50,  200,  50) ;
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,10,utf8_decode("Declaración del siniestro "),0,1,"C");   
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,6,utf8_decode('Poliza: '.$poliza."                                                            Nombre del Asegurado: ".$empresa),0,1,"C");   
$pdf->Cell(0,6,utf8_decode('Domicilio:   '.$domicilio),0,1,"L");
$pdf->Cell(0,6,utf8_decode('Números de contacto: '.$contacto),0,1,"L");
$pdf->Cell(0,6,utf8_decode('Nombre de la persona que declara: '.$_SESSION['user']->nombre." ".$_SESSION['user']->apaterno." ".$_SESSION['user']->amaterno),0,1,"L");
$pdf->Cell(0,6,utf8_decode('Teléfono fijo:'.$_SESSION['user']->tel.'                                                                       Celular:'.$_SESSION['user']->cell),0,1,"L");
$pdf->Cell(0,6,utf8_decode('Domicilio: '.$_SESSION['user']->domicilio),0,1,"L");
$pdf->Line (10,  105,  200,  105) ;
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,8,utf8_decode("Descripción de los hechos"),0,1,"C");   
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,6,utf8_decode("Nota: El declarante deberá mencionar detalles como son: fechas, horas, nombres, etc."),0,1,"C"); 
$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(190,6,utf8_decode("Aqui va mucha informacion hasta que se canse el usuario de escribir y narrar los sucesos del accidente que quiere reportar  como cuandao donde porque quien y a que hora sucedio todo"),0,"L",0);
 $pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode("¿Tomó conocimiento alguna autoridad?: SI/NO "),0,1,"L");
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,utf8_decode("¿Qué autoridad? borrar si no                                                               Folio: ___________"),0,1,"L");
$pdf->Cell(0,10,utf8_decode("¿En su percepción, ¿Cuál fue la causa del siniestro?:  "),0,1,"L");
$pdf->Cell(0,10,utf8_decode("¿Qué medidas se tomaron después de tener conocimiento?:  "),0,1,"L");
$pdf->Cell(0,10,utf8_decode("Las perdidas consistieron en:"),0,1,"L");
$pdf->Cell(0,10,utf8_decode("Monto estimado:"),0,1,"L");

$pdf->MultiCell(190,6,utf8_decode("En caso de existir terceros afectados, mencione sus nombres y teléfonos de contacto."),0,"L",0);
$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(190,10,utf8_decode(""),0,"L",0);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(190,6,utf8_decode("Declaro que los datos que anteceden corresponden a la realidad al momento de la firma de este \n documento."),0,"L",0);  
$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(190,10,utf8_decode(""),0,"L",0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,utf8_decode("A ".$dia." de ".$meses." de ".$anio),0,1,"R");

$pdf->Output();
?>