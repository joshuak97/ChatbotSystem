<?php
session_start();
include "../consulSQL.php";

$estado="cerrada";
$fondo=0;
$fecha="NOW()";
$id_usuario=$_SESSION['id_usuario'];

$enlace=ejecutarSQL::conectar();

if($venta_prods=mysqli_query($enlace,"INSERT INTO caja(estado, id_usuario, fecha_operacion, fondo) VALUES ('$estado',$id_usuario,$fecha,'$fondo')")){
echo "<script>$('#modal_cerrar_caja').modal('show');</script>"; 
}

?>
