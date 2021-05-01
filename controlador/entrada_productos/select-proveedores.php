<?php 
 session_start();
 include '../consulSQL.php';


 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM proveedor WHERE id_sucursal=".$_SESSION['id_sucursal']." ORDER BY id_proveedor DESC");
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_proveedor'].'">'.$proveedores['nombre_proveedor'].'</option>';
       }
 ?>
 
