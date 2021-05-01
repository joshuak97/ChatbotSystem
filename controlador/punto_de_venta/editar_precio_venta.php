<?php
session_start();
include "../consulSQL.php";
$id_producto=$_POST['id_producto'];
$precio_venta=$_POST['precio_venta'];

$enlace=ejecutarSQL::conectar();

if($venta_prods=mysqli_query($enlace,"UPDATE producto set precio_venta='$precio_venta' WHERE id_producto=$id_producto")){
echo "<script>recargar_carrito();</script>";


}

?>