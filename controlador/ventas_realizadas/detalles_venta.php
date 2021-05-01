<?php
session_start();
include "../consulSQL.php";
 $consul_venta=  ejecutarSQL::consultar("SELECT * FROM venta_producto inner join producto on producto.id_producto=venta_producto.id_producto WHERE id_venta=".$_POST['id_venta']);
?>

<div class="text-center"><h3>Folio: <?php echo $_POST['folio_venta']?></h3></div>
     <table class="table table-bordered" style="text-align:center;" width="100%" cellspacing="0">
                 
                  <thead>
                  <th>Codigo</th><th>Producto</th><th>Cantidad</th><th>Precio</th> 
                 </thead>
                 
                  
                  <tbody>
                    <?php
                
                 while ($venta=mysqli_fetch_array($consul_venta)){
                 echo "<tr>
                 <td>".$venta['codigo']."</td>
                 <td>".$venta['nombre_producto']."</td>
                 <td>".$venta['cantidad']."</td>
                 <td>".$venta['precio_venta_vp']."</td>
                 </tr>";  
                 }
                 $con_venta=ejecutarSQL::consultar("SELECT * FROM venta inner join metodo_pago on metodo_pago.id_pago=venta.id_pago WHERE id_venta=".$_POST['id_venta']);
                 $venta2=mysqli_fetch_array($con_venta);
                 ?> 
                 <tr>
                 <td><strong>Total:</strong></td><td>$<?php echo $venta2['total_venta'];?></td><td></td><td></td>	
                 </tr>
                  <tr>
                 <td><strong>Importe:</strong></td><td>$<?php echo $venta2['importe'];?></td><td></td><td></td>	
                 </tr>
                  <tr>
                 <td><strong>Cambio:</strong></td><td>$<?php echo $venta2['cambio'];?></td><td></td><td></td>	
                 </tr>
                  </tbody>
                  

                </table>
                <div class="text-center"><h4>Forma de pago: </h4> <h5><?php echo $venta2['metodo_de_pago']?></h5></div>