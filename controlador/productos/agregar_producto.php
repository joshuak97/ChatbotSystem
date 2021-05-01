<?php
session_start();
include "../consulSQL.php";

$codigo=$_POST['codigo'];

$nombre_producto=$_POST['nombre_producto'];

$precio_venta=$_POST['precio_venta'];
$id_categoria=$_POST['id_categoria'];
$id_reelevancia=$_POST['id_reelevancia'];
$link=$_POST['link'];

$existencia=0;
$img=$codigo.".jpg";
$consul_producto=  ejecutarSQL::consultar("SELECT * FROM productos WHERE codigo='".$codigo."'");
$num=mysqli_num_rows($consul_producto);

if ($num>0) {
	header("Location: ../../home.php?modulo=inventario&alert=5");
}else{
if(!$_FILES['img']['name']==""){
if($_FILES['img']['type']=="image/jpeg" || $_FILES['img']['type']=="image/png"){

	if(move_uploaded_file($_FILES['img']['tmp_name'],"../../img/img_productos/".$img)){
if(consultasSQL::InsertSQL("productos", "codigo,nombre_producto,precio_venta,id_categoria,id_reelevancia,imagen,link", "'$codigo','$nombre_producto','$precio_venta','$id_categoria','$id_reelevancia','$img','$link'")){
header("Location: ../../home.php?modulo=inventario&alert=4");	

    }else{
    echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        Error al insertar, por favor intente de nuevo.
        </div>";	
    }	
	}else{
	header("Location: ../../home.php?modulo=inventario&alert=7");	
	}
}else{
header("Location: ../../home.php?modulo=inventario&alert=8");
}	

}else{
	header("Location: ../../home.php?modulo=inventario&alert=6");
}
}
?>