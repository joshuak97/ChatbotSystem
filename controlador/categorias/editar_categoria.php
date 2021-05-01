<?php
session_start();
include "../consulSQL.php";
$id_categoria=$_POST['id_categoria'];
$nombre_categoria=$_POST['nombre_categoria'];




if(consultasSQL::UpdateSQL("categorias", "nombre_categoria='$nombre_categoria'", "id_categoria=$id_categoria")){
echo "<br><div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i> ¡Correcto!</h4></div>
        La información ha sido actualizada.
        </div>";	
    }else{
    echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        Error al editar, por favor intente de nuevo.
        </div>";	
    }	
	


?>