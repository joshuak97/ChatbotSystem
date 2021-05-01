<?php
session_start();
include "../consulSQL.php";
$id_producto=$_POST['id_producto'];






if(consultasSQL::DeleteSQL("producto","id_producto=$id_producto")){
	
header("Location: ../../home.php?modulo=inventario&alert=2");
}else{
header("Location: ../home.php?modulo=inventario&alert=3");
    	    	
	
}

?>