<?php
session_start();
include "../consulSQL.php";

$nombre_proveedor=$_POST['nombre_proveedor'];
$rfc_proveedor=$_POST['rfc_proveedor'];
$direccion_proveedor=$_POST['direccion_proveedor'];
$telefono_proveedor=$_POST['telefono_proveedor'];
$correo_proveedor=$_POST['correo_proveedor'];
$id_sucursal=$_POST['id_sucursal'];

$consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM proveedor WHERE nombre_proveedor='".$nombre_proveedor."' AND rfc_proveedor='".$rfc_proveedor."' AND id_sucursal=".$_SESSION['id_sucursal']);
$num=mysqli_num_rows($consul_proveedores);

if ($num>0) {
	echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        El proveedor que ha ingresado, ya se encuentra registrado en el sistema.
        </div>";
}else{
if(consultasSQL::InsertSQL("proveedor", "nombre_proveedor, rfc_proveedor, direccion_proveedor, telefono_proveedor, correo_proveedor, id_sucursal", "'$nombre_proveedor','$rfc_proveedor','$direccion_proveedor','$telefono_proveedor','$correo_proveedor','$id_sucursal'")){
echo "<br><div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i> ¡Correcto!</h4></div>
        El proveedor se ha registrado con exito.
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