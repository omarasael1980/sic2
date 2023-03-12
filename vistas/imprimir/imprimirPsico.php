
<?php
ob_start();
include '../../modelo/usuarios/usuarios.php';
 include '../complementos/cabeceraImpresion.php';
?>
<?php
$html = ob_clean();
echo $html;
$html2 = " <div class= 'container'>
<div class='row'>
    <p class='text-center'>
       <img src='http://sisante.com.mx/img/empresarial/logoMembrete.png' height='120 px' alt='Logo'>
    </p>
</div>
</div>";
require_once "../../librerias/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dpdf = new Dompdf();
//opciones de dompdf p
$opciones = $dpdf->getOptions();
$opciones->set(array('isRemoteEnabled' => false));
$dpdf->setOptions($opciones);
$dpdf->loadhtml($html2);
$dpdf->setPaper('letter'); 
//$dpdf->setPaper('A4',landscape);
$dpdf->render();
$dpdf->stream("nombre.pdf", array("Attachment" =>false)); // false si queremos que n0 se descargue



?>