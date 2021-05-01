<?php

session_start();


include '../controlador/consulSQL.php';

require '../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

 ob_start();

 include(dirname('__FILE__').'/factura_html.php');

$content = ob_get_clean();

    try{
        // init HTML2PDF
        $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output('Auditoria.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>