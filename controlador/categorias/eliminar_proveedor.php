
<?php
session_start();
include "../consulSQL.php";
$id_proveedor=$_POST['id_proveedor'];



$consul_entrada=  ejecutarSQL::consultar("SELECT * FROM entrada WHERE id_proveedor=$id_proveedor");
$num_entradas=mysqli_fetch_array($consul_entrada);
$consul_productos=  ejecutarSQL::consultar("SELECT * FROM producto WHERE id_proveedor=$id_proveedor");
$num_prods=mysqli_fetch_array($consul_productos);
if($num_prods>0 || $num_entradas>0) {
header("Location: ../../home.php?modulo=proveedores&alert=1"); 
}else{
header("Location: ../../home.php?modulo=proveedores&alert=2");
if(consultasSQL::DeleteSQL("proveedor","id_proveedor=$id_proveedor")){
	

}else{
header("Location: ../home.php?modulo=proveedores&alert=3");
    	    }	
	
}

?>