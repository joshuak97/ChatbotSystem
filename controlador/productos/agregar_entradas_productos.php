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
          if(!move_uploaded_file($_FILES['archivo']['tmp_name'],"../../entradas/".$_FILES['archivo']['name'])){
               
            header("Location: ../../home.php?modulo=inventario&alert=4"); 
               
                }
    }
$validar=0;

$verDueno=ejecutarSQL::consultar("SELECT * from entrada where id_sucursal=$id_sucursal  AND id_usuario=$id_usuario order by id_entrada desc limit 1");
$entrada=mysqli_fetch_array($verDueno);
    # code...
for($i=0;$i<$_SESSION['contadorProducto'];$i++){
$id_entrada=$entrada['id_entrada'];
$verProd=ejecutarSQL::consultar("SELECT * from producto  where id_producto=".$_SESSION['tablaProducto'][$i]);
$prod=mysqli_fetch_array($verProd);
$costo_unitario=$_SESSION['precio_costo'][$i];
$id_producto=$_SESSION['tablaProducto'][$i];
$cantidad=$_SESSION['cantidad'][$i];
$existencia=$prod['existencia'];
$nueva_existencia=$existencia+$cantidad;

if(consultasSQL::InsertSQL("entrada_producto", "id_producto,id_entrada,costo_unitario,cantidad","$id_producto,$id_entrada,'$costo_unitario',$cantidad")){
if(!$descuento=consultasSQL::UpdateSQL("producto","existencia=$nueva_existencia","id_producto=".$_SESSION['tablaProducto'][$i])){
$validar++;
 
  }

}else{
$validar++;
      }
        }

        if ($validar==0) {
        header("Location: ../../home.php?modulo=inventario&alert=5"); 
        }

    }else{

      header("Location: ../../home.php?modulo=inventario&alert=6"); 
    
    }

    }else{
      header("Location: ../../home.php?modulo=inventario&alert=7"); 

    }	
	

?>