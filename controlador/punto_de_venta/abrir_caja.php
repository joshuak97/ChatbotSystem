<?php
session_start();
include "../consulSQL.php";

$estado="abierta";
$fondo=$_POST['fondo'];
$fecha="NOW()";
$id_usuario=$_SESSION['id_usuario'];

$enlace=ejecutarSQL::conectar();

if($venta_prods=mysqli_query($enlace,"INSERT INTO caja(estado, id_usuario, fecha_operacion, fondo) VALUES ('$estado',$id_usuario,$fecha,'$fondo')")){
header("Location: ../../home.php?modulo=punto_de_venta");
}

?>
