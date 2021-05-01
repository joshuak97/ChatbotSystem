<?php
session_start();
include '../consulSQL.php';
ini_set('date.timezone','America/Mexico_City');
$enlace=ejecutarSQL::conectar();
if ($_SESSION['contadorProducto']>0) {
  if ($_POST['importe']>=$_SESSION['sumaTotal']) {
$importe=$_POST['importe'];
$cambio=$importe-$_SESSION['sumaTotal'];
$folio_venta=substr(date('YmdHis',time()), 2);
$fecha_venta='NOW()';
$total_venta=$_SESSION['sumaTotal'];
$status="REALIZADA";
$id_pago=$_POST['id_pago'];
$id_sucursal=$_SESSION['id_sucursal'];
$id_usuario=$_SESSION['id_usuario'];
$contador=0;
//Registramos la venta
if(mysqli_query($enlace, "INSERT INTO venta(folio_venta, fecha_venta, total_venta, status, id_pago, id_sucursal,importe,cambio,id_usuario) VALUES ('$folio_venta',$fecha_venta,'$total_venta','$status','$id_pago','$id_sucursal','$importe','$cambio',$id_usuario)")){
  //Obtenemos el id de la venta que acabamos de registrar
$consul_venta=mysqli_query($enlace,"SELECT id_venta FROM venta WHERE id_sucursal=".$id_sucursal." AND id_usuario=$id_usuario ORDER BY id_venta DESC LIMIT 1");
$venta=mysqli_fetch_array($consul_venta);
$id_venta=$venta['id_venta'];
//Recorremos el carrito para poder registrar los productos vendidos y se descuentan las existencias
for($i=0;$i<$_SESSION['contadorProducto'];$i++){
$consul_producto=mysqli_query($enlace,"SELECT precio_venta,existencia FROM producto WHERE id_producto=".$_SESSION['tablaProducto'][$i]);
$producto=mysqli_fetch_array($consul_producto);
$precio_venta_vp=$producto['precio_venta'];
$nueva_existencia=$producto['existencia']-$_SESSION['cantidad'][$i];
if($venta_prods=mysqli_query($enlace,"INSERT INTO venta_producto(id_venta, id_producto, precio_venta_vp, cantidad) VALUES ($id_venta,".$_SESSION['tablaProducto'][$i].",'$precio_venta_vp',".$_SESSION['cantidad'][$i].")")){
  //Descontamos las existencias de dicho producto
  if(!$descuento=mysqli_query($enlace,"UPDATE producto SET existencia=$nueva_existencia WHERE id_producto=".$_SESSION['tablaProducto'][$i])){
$contador++;
  echo "<script>alert('Error al actualizar algunas existencias, consulte a soporte');</script>";
  }
}else{
  $contador++;
  echo "<script>alert('Algunos productos no fueron registrados, favor de realizar la venta de nuevo');</script>";
}
}
}else{
  $contador++;
  if($contador==0){
 echo "<script>alert('Error al registrar la venta, por favor intente de nuevo');";
}
}
$_SESSION['id_venta_realizada']=$id_venta;
echo '<script>$("#modal_venta_realizada").modal("show");</script>';
}else{
echo "<script>alert('El importe debe ser mayor o igual al total de la compra');";  
}
}else{
echo '<script>alert("No hay productos agregados al carrito");</script>';
}
?>