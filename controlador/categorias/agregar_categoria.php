<?php
session_start();
include "../consulSQL.php";

$nombre_categoria=$_POST['nombre_categoria'];


$consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias WHERE nombre_categoria='".$nombre_categoria."'");
$num=mysqli_num_rows($consul_proveedores);

if ($num>0) {
	echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        Esta categoria que ha ingresado, ya se encuentra registrado en el sistema.
        </div>";
}else{
if(consultasSQL::InsertSQL("categorias", "nombre_categoria", "'$nombre_categoria'")){
echo "<br><div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i> ¡Correcto!</h4></div>
        Esta categoria se ha registrado con exito.
        </div>";	
    }else{
    echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        Error al insertar, por favor intente de nuevo.
        </div>";	
    }	
	
}

?>