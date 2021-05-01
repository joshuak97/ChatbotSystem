<?php
session_start();
require_once "../../controlador/consulSQL.php";
ini_set('date.timezone','America/Mexico_City');

$concaja=ejecutarSQL::consultar("SELECT*FROM caja WHERE id_usuario=".$_SESSION['id_usuario']." ORDER BY id_caja desc limit 1");
$num_caja=mysqli_num_rows($concaja);
$caja=mysqli_fetch_array($concaja);
if($caja['estado']=='abierta' || $num_caja<=0){
$estado="cerrada";
$fondo=0;

$_SESSION['fondo']=$caja['fondo'];
$id_usuario=$_SESSION['id_usuario'];
$enlace=ejecutarSQL::conectar();
$fecha="NOW()";

if($venta_prods=mysqli_query($enlace,"INSERT INTO caja(estado, id_usuario, fecha_operacion, fondo) VALUES ('$estado',$id_usuario,$fecha,'$fondo')")){

$_SESSION['inicio']=$caja['fecha_operacion'];





class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

$total_genericos=0;
$total_patentes=0;
	$fecha="NOW()";
	$fin=date('Y-m-d H:i:s',time());
	$total_efectivo=0;
	$pagos_tarjeta=0;

	$id_usuario=$_SESSION['id_usuario'];
	$fondo=$_SESSION['fondo'];
	$inicio=$_SESSION['inicio'];
	$genericos_efectivo=0;
$genericos_tarjeta=0;
$patente_efectivo=0;
$patenta_tarjeta=0;
//TRAEMOS LA INFORMACIÓN DE LA VENTA

$consul_producto=ejecutarSQL::consultar("SELECT*FROM venta_producto inner join venta on venta_producto.id_venta=venta.id_venta inner join producto on producto.id_producto=venta_producto.id_producto WHERE fecha_venta>='$inicio'AND generico_patente='generico'  AND venta.id_usuario=$id_usuario   ORDER BY id_vp asc");


$consul_producto2=ejecutarSQL::consultar("SELECT*FROM venta_producto inner join venta on venta_producto.id_venta=venta.id_venta inner join producto on producto.id_producto=venta_producto.id_producto WHERE fecha_venta>='$inicio' AND generico_patente='patente' AND venta.id_usuario=$id_usuario ORDER BY id_vp asc");

$consul_ventas_efectivo=ejecutarSQL::consultar("SELECT*FROM venta WHERE fecha_venta>='$inicio' AND id_pago=1 AND venta.id_usuario=$id_usuario ORDER BY id_venta asc");
while ($efectivo=mysqli_fetch_array($consul_ventas_efectivo)) {
	$total_efectivo+=$efectivo['total_venta'];
}

$consul_ventas_tarjeta=ejecutarSQL::consultar("SELECT*FROM venta WHERE fecha_venta>='$inicio' AND id_pago!=1 AND venta.id_usuario=$id_usuario ORDER BY id_venta asc");
while ($tarjeta=mysqli_fetch_array($consul_ventas_tarjeta)) {
	$pagos_tarjeta+=$tarjeta['total_venta'];
}
$total_efectivo=number_format($total_efectivo,2);
$pagos_tarjeta=number_format($pagos_tarjeta,2);

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
			
				

				<br><br>
				FARMACIA FISAR
				
			

				<br>
				Dirección: Calle Alvaro Obregón S/N Zona Centro 92730, Alamo Temapache, Veracruz.

				


			</div>
<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloquex = <<<EOF

<table style="font-size:9px; text-align:center">

	
		<tr>
	<td style="width:160px;">
		CAJERO: $_SESSION[nombre_completo]
		</td>
		</tr><tr>
	<td style="width:160px;">
		TURNO: $inicio - $fin
		<br><br>
		</td>
		</tr>
		<tr>
		<td style="width:160px;text-align:left">
			 ----------- GENERICOS---------------
			 <br>
		</td>

	</tr>
</table>

EOF;

$pdf->writeHTML($bloquex, false, false, false, false, '');


while($productos_genericos=mysqli_fetch_array($consul_producto)){

$total_genericos+=$productos_genericos['precio_venta']*$productos_genericos['cantidad'];


$valorUnitario = number_format($productos_genericos["precio_venta"],2);
if($productos_genericos['id_pago']==1){
$genericos_efectivo+=$valorUnitario*$productos_genericos['cantidad'];
}else{
$genericos_tarjeta+=$valorUnitario*$productos_genericos['cantidad'];	
}
$precioTotal = number_format($valorUnitario*$productos_genericos['cantidad'], 2);
$cantidad=$productos_genericos['cantidad'];
$bloque2 = <<<EOF

<table style="font-size:9px;">
<tr>
	
		<td style="width:160px; text-align:left">
		Venta: $productos_genericos[folio_venta] 
		</td>

	</tr>
<tr>
	
		<td style="width:160px; text-align:left">
		$productos_genericos[folio_venta] 
		</td>

	</tr>
	<tr>

	
		<td style="width:200px; text-align:left">
		$productos_genericos[nombre_producto] 
		</td>

	
	</tr>
	<tr>
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $cantidad  = $ $precioTotal
		<br>
		</td>

	</tr>

</table><br>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}
$total_genericos=number_format($total_genericos,2);

// ---------------------------------------------------------
$bloquey = <<<EOF

<table style="font-size:9px; text-align:center">

	
		<tr>
		<td style="width:160px;text-align:left">
		<br><br><br>
			 ----------- PATENTE---------------
		</td>

	</tr>
</table>

EOF;

$pdf->writeHTML($bloquey, false, false, false, false, '');

// ---------------------------------------------------------

while($productos_patente=mysqli_fetch_array($consul_producto2)){

$total_patentes+=$productos_patente['precio_venta']*$productos_patente['cantidad'];

$valorUnitario = number_format($productos_patente["precio_venta"],2);
if($productos_patente['id_pago']==1){
$patente_efectivo+=$valorUnitario*$productos_patente['cantidad'];
}else{
$patente_tarjeta+=$valorUnitario*$productos_patente['cantidad'];	
}

$precioTotal = number_format($valorUnitario*$productos_patente['cantidad'], 2);
$cantidad=$productos_patente['cantidad'];
$bloque3 = <<<EOF

<table style="font-size:9px;">
	
	<tr>
	
		<td style="width:160px; text-align:left">
		$productos_patente[folio_venta] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:left">
		$productos_patente[nombre_producto] 
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

$pdf->writeHTML($bloque3, false, false, false, false, '');

}
$total_patentes=number_format($total_patentes,2);
$total_final=number_format($total_genericos+$total_patentes+$fondo,2);
$genericos_efectivo=number_format($genericos_efectivo,2);
$genericos_tarjeta=number_format($genericos_tarjeta,2);
$patente_efectivo=number_format($patente_efectivo,2);
$patente_tarjeta=number_format($patente_tarjeta,2);
$bloque4 = <<<EOF

<table style="font-size:9px; text-align:left">

	

	

	<tr>
	
		<td style="width:160px;">
			 ----------------------------------------------
		</td>

	</tr>
	<tr>
	
		<td style="width:160px;">
		CORTE DE GENERICOS:
		</td>

		

	</tr>
	<tr>
	
		<td style="width:160px;">
		-----------------------------------------------
		</td>

		

	</tr>
<tr>
	
		<td style="width:160px;">
			 Efectivo: $ $genericos_efectivo
		</td>

		

	</tr>
<tr>
	
		<td style="width:160px;">
			 Pagos con tarjeta: $ $genericos_tarjeta
		</td>

		

	</tr>
	
	<tr>
	
		<td style="width:160px;">
			 TOTAL GENERICOS: $ $total_genericos
		</td>

		

	</tr>
<tr>
	
		<td style="width:160px;">
		-------------------------------------------
		</td>

		

	</tr>	
<tr>
	
		<td style="width:160px;">
		CORTE DE PATENTES:
		</td>

		

	</tr>
	<tr>
	
		<td style="width:160px;">
		---------------------------------------------
		</td>

		

	</tr>
<tr>
	
		<td style="width:160px;">
			 Efectivo: $ $patente_efectivo
		</td>

		

	</tr>
<tr>
	
		<td style="width:160px;">
			 Pagos con tarjeta: $ $patente_tarjeta
		</td>

		

	</tr>
	<tr>
	
		<td style="width:160px;">
			 TOTAL PATENTES: $ $total_patentes
		</td>

	</tr>
	<tr>
	
		<td style="width:160px;">
		---------------------------------------------
		</td>

		

	</tr>
	<tr>
	
		<td style="width:160px;">
			 FONDO: $ $fondo
		</td>

	</tr>
<tr>
	
</tr>

	<tr>
	
		<td style="width:160px;">
			 PAGOS EN EFECTIVO: $ $total_efectivo
		</td>

		

	</tr>

<tr>
	
		<td style="width:160px;">
			 PAGOS CON TARJETA: $ $pagos_tarjeta
		</td>

		

	</tr>

<tr>
		<td style="width:160px;">
			 TOTAL DE CORTE: $ $total_final
		</td>

		
</tr>
		

</table>



EOF;
$pdf->writeHTML($bloque4, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
ob_end_clean();
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = "Corte caja";
$factura -> traerImpresionFactura();

}
}else{
echo '<h2>No se ha abierto caja, o ya se realizó un corte de caja.</h2>';	
}
?>