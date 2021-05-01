<?php
session_start();
require_once "../../controlador/consulSQL.php";


class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$consul_producto=ejecutarSQL::consultar("SELECT*FROM venta WHERE id_venta=".$_GET['codigo']);
$respuestaVenta=mysqli_fetch_array($consul_producto);
$valorVenta=$respuestaVenta['folio_venta'];


$fecha = substr($respuestaVenta["fecha_venta"],0,-8);

$cambio = number_format($respuestaVenta["cambio"],2);
$importe = number_format($respuestaVenta["importe"],2);
$total = number_format($respuestaVenta["total_venta"],2);





//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Fecha: $fecha

				<br><br>
				FARMACIA FISAR
				
			

				<br>
				Dirección: Zona Centro

				

				<br>
				FOLIO: $valorVenta

				
				

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


for($i=0;$i<$_SESSION['contadorProducto'];$i++){
$consul_producto=ejecutarSQL::consultar("SELECT*FROM producto WHERE id_producto=".$_SESSION['tablaProducto'][$i]);
$item=mysqli_fetch_array($consul_producto);

$valorUnitario = number_format($item["precio_venta"],2);

$precioTotal = number_format($valorUnitario*$_SESSION['cantidad'][$i], 2);
$cantidad=$_SESSION['cantidad'][$i];
$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		$item[nombre_producto] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $cantidad  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	

	

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>
<tr>
	
		<td style="width:80px;">
			 IMPORTE: 
		</td>

		<td style="width:80px;">
			$ $importe
		</td>

	</tr>
<tr>
	
		<td style="width:80px;">
			 CAMBIO
		</td>

		<td style="width:80px;">
			$ $cambio
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su compra
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
ob_end_clean();
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();
?>