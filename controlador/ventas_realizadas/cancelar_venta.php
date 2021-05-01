
<?php
session_start();
include "../consulSQL.php";
$id_venta=$_POST['id_venta'];
$validar=0;
$consul_productos=ejecutarSQL::consultar("SELECT * FROM venta_producto WHERE id_venta=".$id_venta);
while($producto_venta=mysqli_fetch_array($consul_productos)){
$id_producto=$producto_venta['id_producto'];
$consul_producto=  ejecutarSQL::consultar("SELECT * FROM producto WHERE id_producto=$id_producto");
$prods=mysqli_fetch_array($consul_producto);
$nuevo_stock=$prods['existencia']+$producto_venta['cantidad'];
if(!consultasSQL::UpdateSQL("producto", "existencia='$nuevo_stock'", "id_producto=$id_producto")){
$validar++;
}
}
$id_usuario=$_SESSION['id_usuario'];
if($validar>0) {
header("Location: ../../home.php?modulo=ventas_realizadas&alert=1"); 
}else{

if(consultasSQL::UpdateSQL("venta", "status='CANCELADA'", "id_venta=$id_venta")){
if(consultasSQL::InsertSQL("cancelaciones", "status_cancelacion,id_venta,id_usuario","'APROBADA',$id_venta,$id_usuario")){
header("Location: ../../home.php?modulo=ventas_realizadas&alert=2");

}

}else{
header("Location: ../home.php?modulo=ventas_realizadas&alert=3");
    	    }	
	
}


?>