
<?php
session_start();
include "../consulSQL.php";
$id_cancelacion=$_POST['id_cancelacion'];
$consul_cancelacion=ejecutarSQL::consultar("SELECT * FROM cancelaciones WHERE id_cancelacion=".$id_cancelacion);
$cancelacion=mysqli_fetch_array($consul_cancelacion);
$id_venta=$cancelacion['id_venta'];
$validar=0;

$consul_productos=ejecutarSQL::consultar("SELECT * FROM venta_producto WHERE id_venta=".$id_venta);
while($producto_venta=mysqli_fetch_array($consul_productos)){
$id_producto=$producto_venta['id_producto'];
$consul_producto=  ejecutarSQL::consultar("SELECT * FROM producto WHERE id_producto=$id_producto");
$prods=mysqli_fetch_array($consul_producto);
$nuevo_stock=$prods['existencia']-$producto_venta['cantidad'];
if(!consultasSQL::UpdateSQL("producto", "existencia='$nuevo_stock'", "id_producto=$id_producto")){
$validar++;
}
}
$id_usuario=$_SESSION['id_usuario'];
if($validar>0) {
header("Location: ../../home.php?modulo=ventas_canceladas&alert=1"); 
}else{

if(consultasSQL::UpdateSQL("venta", "status='CANCELADA'", "id_venta=$id_venta")){
if(consultasSQL::UpdateSQL("cancelaciones", "status_cancelacion='APROBADA'","id_cancelacion=$id_cancelacion")){
header("Location: ../../home.php?modulo=ventas_canceladas&alert=2");

}

}else{
header("Location: ../home.php?modulo=ventas_canceladas&alert=3");
    	    }	
	
}


?>