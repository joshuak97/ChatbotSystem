<?php
include('../consulSQL.php');

$consulta=ejecutarSQL::consultar("SELECT precio_venta from Producto where id_producto=".$_POST['id_producto']);
    while($fila=mysqli_fetch_array($consulta)){
    	echo ' <label>Precio de venta</label>
       <input type="number" class="form-control" step="0.01" id="precio_venta" value="'.$fila['precio_venta'].'" placeholder="$0.00">';
    }
?>