<?php
session_start();
include "../consulSQL.php";
$id_proveedor=$_POST['id_proveedor'];
$nombre_proveedor=$_POST['nombre_proveedor'];
$rfc_proveedor=$_POST['rfc_proveedor'];
$direccion_proveedor=$_POST['direccion_proveedor'];
$telefono_proveedor=$_POST['telefono_proveedor'];
$correo_proveedor=$_POST['correo_proveedor'];
$id_sucursal=$_POST['id_sucursal'];



if(consultasSQL::UpdateSQL("proveedor", "nombre_proveedor='$nombre_proveedor', rfc_proveedor='$rfc_proveedor', direccion_proveedor='$direccion_proveedor', telefono_proveedor='$telefono_proveedor', correo_proveedor='$correo_proveedor', id_sucursal=$id_sucursal", "id_proveedor=$id_proveedor")){
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