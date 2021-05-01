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
$consultaSuc=ejecutarSQL::consultar("SELECT*FROM sucursal inner join ubicacion on sucursal.idUbicacion=ubicacion.idUbicacion");

while($resSuc=mysqli_fetch_array($consultaSuc)){
    if($_SESSION['condiciones']!=""){
    
$consulta0=ejecutarSQL::consultar($_SESSION['consultaInventario']." WHERE idSucursal=".$resSuc['idSucursal']." $_SESSION[complemento]");
	   
    }else{
    
    $consulta0=ejecutarSQL::consultar($_SESSION['consultaInventario']." $_SESSION[condiciones] AND idSucursal=".$resSuc['idSucursal']." $_SESSION[complemento]");
    
    }
$fila0=mysqli_num_rows($consulta0);
$numeroProds=ceil($fila0/50);
$con=1;
for($i=1;$i<=$numeroProds;$i++){
$iniciar=($i-1)*50;
$hasta=50;
?>
<page backtop="15mm" backbottom="15mm" backleft="10mm" backright="10mm" style="font-size: 12pt; font-family: arial" ><br>
<page_header>
    <?php 
    
    include("encabezado_productos_todo.php");
	if($_SESSION['condiciones']!=""){
    $consulta1=ejecutarSQL::consultar($_SESSION['consultaInventario']." WHERE idSucursal=".$resSuc['idSucursal']." $_SESSION[complemento]"." limit $iniciar,$hasta");
    
    }else{
$consulta1=ejecutarSQL::consultar($_SESSION['consultaInventario']." $_SESSION[condiciones] AND idSucursal=".$resSuc['idSucursal']." $_SESSION[complemento]"." limit $iniciar,$hasta");
	
    }
	?>
   </page_header>
   
	<div style="text-align:center;width:100%"><?php echo '<h4 style="text-align:center;">Total de productos: '.$fila0.'</h4>';?><br>
    <table style="width: 100%; text-align: center;font-size: 11px;border-collapse: collapse;" border="0.2">
		
        <tr>
		   <td style="width:5%;"><strong>N°</strong></td> 		
           <td style="width:20%;"><strong>CODIGO</strong></td> 	
           <td style="width:30%;"><strong>PRODUCTO</strong></td>
		   <td style="width:10%;"><strong>P.VENTA</strong></td>
		   <td style="width:10%;"><strong>EXISTENCIA</strong></td>
           <td style="width:10%;"><strong>C/FALLAS</strong></td>
           <td style="width:15%;"><strong>SUCURSAL</strong></td>
        </tr>
		 
        <?php

    
    while($fila = mysqli_fetch_array($consulta1)) {	    
    echo "<tr><td style='width:5%;'>$con</td>
    <td style='width:20%;'>".$fila['codProd']."</td>
    <td style='width:30%;'> ".$fila['nombreProd']."</td>
    <td style='width:10%;'>".$fila['precioVenta']."</td>
    <td style='width:10%;'>".$fila['existencia']."</td>
    <td style='width:10%;'>".$fila['stockDanado']."</td>";
    $consulta2=ejecutarSQL::consultar("SELECT nombreSucursal FROM sucursal where idSucursal=".$fila['idSucursal']);
	$suc=mysqli_fetch_array($consulta2);
    echo "<td style='width:15%;'>".$suc['nombreSucursal']."</td>";
    echo "</tr>";
    $con++;	
    }
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
                    &copy; <?php echo "EworkSolutions "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
		
    </page_footer>
	  

</page>
<?php
}
}
?>
