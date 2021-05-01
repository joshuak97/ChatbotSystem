<style type="text/css">
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 8mm;border-collapse:collapse; border: none;}
}
table{
border-color:black;    
}
td{
border-color:black;    
}
</style>
<?php
$consulta=ejecutarSQL::consultar("SELECT*FROM producto inner join proveedor on producto.id_proveedor=proveedor.id_proveedor WHERE producto.id_sucursal=".$_SESSION['id_sucursal']);
$fila0=mysqli_num_rows($consulta);
$con=1;
$html="";
?>
<page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm" style="font-size: 12pt; font-family: arial" ><br>
<page_header>
    <?php 
    
    include("encabezado_productos.php");
	
	
	?>
   </page_header>
   
	<div style="text-align:center;width:100%"><?php echo '<h4 style="text-align:center;">Total de productos: '.$fila0.'</h4>';?><br>
    <table style="width: 100%; text-align: center;font-size: 11px;border-collapse: collapse;" border="0.2">
		
        
                    <tr>
                      <td>Codigo</td>
                      <td>Descripcion</td>
                      <td>Principio A.</td>
                      <td>Generico/Patentes</td>
                      <td>Stock</td> 
                     

                      <td>P. Costo</td>
                    
                     
                      <td>P.Venta</td>
                      <td>Laboratorio</td>
                     
                    </tr>
                 
		 
        <?php

    
    while($productos = mysqli_fetch_array($consulta)) {     
     $html.= "<tr>
                      <td>".$productos['codigo']."</td>
                      <td>".$productos['nombre_producto']."</td>
                      <td>".$productos['principio_activo']."</td>
                      <td>".$productos['generico_patente']."</td>
                      <td>".$productos['existencia']."</td>
                      <td>".$productos['precio_costo']."</td>
                      <td>".$productos['precio_venta']."</td>
                      <td>".$productos['nombre_proveedor']."</td>
                      </tr>";
        }

    echo $html;
        ?>

   </table>
 	
	
	</div>
	
	<page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Farmacia FISAR "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
		
    </page_footer>
	  

</page>

