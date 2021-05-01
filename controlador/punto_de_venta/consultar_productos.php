<?php
session_start();
include('../consulSQL.php');

if (!$_POST['valor']=="") {
 
$verDueno=ejecutarSQL::consultar("SELECT * from producto where id_sucursal=$_SESSION[id_sucursal]  AND (nombre_producto like '%$_POST[valor]%' or codigo like '%$_POST[valor]%') order by nombre_producto asc");

echo '<div class="table-responsive" style="padding:1%;"><table class="table-bordered" style="text-align:center;width:100%;">
<tr><th>Codigo</th><th>Nombre</th><th>Precio de Venta</th><th>Tipo</th><th>Stock</th><th>Seleccionar</th></tr>';
                                while($dueno=mysqli_fetch_array($verDueno)){
                                  if($dueno['existencia']<1){
                                   echo '<tr style="background:orange;color:white">';
                                  }else{
                                    echo '<tr>';
                                  }
                                echo '
                                <td>'.$dueno['codigo'].'</td>
                                <td>'.$dueno['nombre_producto'].'</td>                                
                                <td>'.$dueno['precio_venta'].'</td>
                                <td>'.$dueno['generico_patente'].'</td>
                                <td>'.$dueno['existencia'].'</td>';

                               ?>
                                <td><a class="bnt btn-success btn-circle btn-sm" style="color: white;" onclick="seleccionar_producto(<?php echo $dueno['id_producto'];?>);"><i class="fa fa-shopping-cart"></i></a></td></tr>
                               <?php
                                }	
                               	

                                echo '</table><div>';

                              }else{

                              echo '<div class="table-responsive" style="padding:3%;"><table class="table-bordered" style="text-align:center;width:100%;">
<tr><th>Codigo</th><th>Nombre</th><th>Precio de Venta</th><th>Seleccionar</th></tr>';
 echo '</table><div>';

  
                              }

?>