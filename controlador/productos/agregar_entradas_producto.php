<?php
session_start();
include "../consulSQL.php";

$folio_entrada=$_POST['folio_entrada'];
$fecha_entrada=$_POST['fecha_entrada'];
$id_sucursal=$_POST['id_sucursal'];
$id_proveedor=$_POST['id_proveedor'];
$id_usuario=$_POST['id_usuario'];
if(!$_FILES['archivo']['name']==""){
$archivo=$_FILES['archivo']['name'];
}else{
$archivo="";    
}


if($_SESSION['contadorProducto']>0){


if(consultasSQL::InsertSQL("entrada", "folio_entrada, fecha_entrada, archivo, id_proveedor, id_sucursal, id_usuario", "'$folio_entrada','$fecha_entrada','$archivo',$id_proveedor,$id_sucursal,$id_usuario")){
    if(!$_FILES['archivo']['name']==""){
          if(!move_uploaded_file($_FILES['img']['tmp_name'],"../../entradas/".$_FILES['img']['name'])){
               echo ' 
                        <img src="../assets/img/incorrectofull.png" class="center-all-contens">
                         <br>
                         <h3>Ha ocurrido un error al cargar el archivo</h3>
                         <p class="lead text-cente">
                         Por favor intente de nuevo    
                         </p>';        
                }
    }
$validar=0;
    # code...
for($i=0;$i<$_SESSION['contadorProducto'];$i++){
$verDueno=ejecutarSQL::consultar("SELECT * from entrada inner join producto on entrada.id_producto=producto.id_producto where id_sucursal=$id_sucursal  AND id_usuario=$id_usuario order by id_entrada desc limit 1");
$entrada=mysqli_fetch_array($verDueno);
$id_entrada=$entrada['id_entrada'];
$costo_unitario=$_SESSION['precio_costo'][$i];
$id_producto=$_SESSION['tablaProducto'][$i];
$cantidad=$_SESSION['cantidad'][$i]];
$existencia=$entrada['existencia'];
$nueva_existencia=$existencia+$cantidad;

if(consultasSQL::InsertSQL("entrada_producto", "id_producto,id_entrada,costo_unitario,cantidad","$id_producto,$id_entrada,'$costo_unitario',$cantidad")){
if(!$descuento=consultasSQL::UpdateSQL(,"producto","existencia=$nueva_existencia","id_producto=".$_SESSION['tablaProducto'][$i])){
$validar++;
 
  }

}else{
$validar++;
      }
        }

        if ($validar==0) {
        echo 'correcto';
        }

echo "<br><div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i> ¡Correcto!</h4></div>
        El producto se ha registrado con exito.
        </div>";	
    }else{
    echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h4></div>
        Error al insertar, por favor intente de nuevo.
        </div>";	
    }

    }else{
 echo "Debe seleccionar al menos un producto, para registrar una entrada";
    }	
	

?>