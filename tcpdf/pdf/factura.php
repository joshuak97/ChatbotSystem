<?php
session_start();
require_once "../../controlador/consulSQL.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;
$html="";
$count=1;
$consulta=ejecutarSQL::consultar("SELECT*FROM producto inner join proveedor on producto.id_proveedor=proveedor.id_proveedor WHERE producto.id_sucursal=".$_SESSION['id_sucursal']." ORDER BY nombre_producto asc");
$fila0=mysqli_num_rows($consulta);


    
    while($productos = mysqli_fetch_array($consulta)) {     
     $html.= "<tr>
                      <td>".$count."</td>
                      <td>".$productos['codigo']."</td>
                      <td>".$productos['nombre_producto']."</td>
                      <td>".$productos['principio_activo']."</td>
                      <td>".$productos['generico_patente']."</td>
                      <td>".$productos['existencia']."</td>
                      <td>".$productos['precio_costo']."</td>
                      <td>".$productos['precio_venta']."</td>
                      <td>".$productos['nombre_proveedor']."</td>
                      </tr>";
                      $count++;
        }


       

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:100px;height:80px;"><img src="images/Fisar2.png"></td>

			<td style="background-color:white; width:300px">
				
				<div style="font-size:13px; text-align:center; line-height:15px;">
					
					<br>
					<strong>Inventario de productos Fisar</strong>

					
				</div>

			</td>
            
			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Direccion: 
					
					<br>
					Calle Alvaro Obregon s/n Zona Centro 92730.

				</div>
				
			</td>

			

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


// ---------------------------------------------------------


// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table style="font-size:8.5px; padding:2px 4px;">

		       <tr>
                      <td><strong>N°</strong></td>
                      <td><strong>Codigo</strong></td>
                      <td><strong>Descripcion</strong></td>
                      <td><strong>Principio A.</strong></td>
                      <td><strong>Generico/Patentes</strong></td>
                      <td><strong>Stock</strong></td> 
                      <td><strong>P. Costo</strong></td>        
                      <td><strong>P.Venta</strong></td>
                      <td><strong>Laboratorio</strong></td>
                     
                    </tr>
		
		$html


	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
ob_end_clean();
$pdf->Output('auditoria.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>