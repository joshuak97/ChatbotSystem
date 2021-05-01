<?php
session_start();
include "../consulSQL.php";
$id_entrada=$_POST['id_entrada'];

$ver=ejecutarSQL::consultar("SELECT * from entrada_producto  where id_ep=".$id_entrada);
$entrada=mysqli_fetch_array($ver);
if(consultasSQL::DeleteSQL("entrada_producto","id_ep=$id_entrada")){
$verProd=ejecutarSQL::consultar("SELECT * from producto  where id_producto=".$entrada['id_producto']);
$prod=mysqli_fetch_array($verProd);
$nueva_existencia=$prod['existencia']-$entrada['cantidad'];
consultasSQL::UpdateSQL("producto","existencia=$nueva_existencia","id_producto=".$prod['id_producto']);
header("Location: ../../home.php?modulo=entradas_producto&alert=2");

}else{
header("Location: ../../home.php?modulo=entradas_producto&alert=3");
    	    
	
}

?>