<?php 
 session_start();
 include '../consulSQL.php';


 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias WHERE id_categoria=".$fila['id_categoria']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_categoria'].'">'.$proveedores['nombre_categoria'].'</option>';
       }
 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias WHERE id_categoria!=".$fila['id_categoria']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_categoria'].'">'.$proveedores['nombre_categoria'].'</option>';
       }

 ?>
 
