
<?php
session_start();
include "../consulSQL.php";
$id_categoria=$_POST['id_categoria'];




$consul_productos=  ejecutarSQL::consultar("SELECT * FROM producto WHERE id_categoria=$id_categoria");
$num_prods=mysqli_fetch_array($consul_productos);
if($num_prods>0) {
header("Location: ../../home.php?modulo=categorias&alert=1"); 
}else{
header("Location: ../../home.php?modulo=categorias&alert=2");
if(consultasSQL::DeleteSQL("categorias","id_categoria=$id_categoria")){
	

}else{
header("Location: ../home.php?modulo=categorias&alert=3");
    	    }	
	
}

?>