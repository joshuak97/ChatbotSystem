<?php
session_start();
include('../consulSQL.php');
$_SESSION['cantidad'][$_POST['posicion']]=$_POST['cantidad'];
$suma=0;
for($i=0;$i<$_SESSION['contadorProducto'];$i++){
$consulta=ejecutarSQL::consultar("SELECT * from producto where id_producto=".$_SESSION['tablaProducto'][$i]);
while($fila=mysqli_fetch_array($consulta)){    
$suma +=$fila['precio_venta']*$_SESSION['cantidad'][$i];    
}
}
$_SESSION['sumaTotal']=$suma;
echo "$".number_format($_SESSION['sumaTotal'],2);