<?php
session_start();
include('../consulSQL.php');

$id_producto=$_POST['id_producto'];
$posicion=0;
for($i=0;$i<$_SESSION['contadorProducto'];$i++){

if($i<$_SESSION['contadorProducto']-1){
if($posicion==0){  
if($_SESSION['tablaProducto'][$i]==$id_producto){

$_SESSION['tablaProducto'][$i]=$_SESSION['tablaProducto'][$i+1];		
$_SESSION['cantidad'][$i]=$_SESSION['cantidad'][$i+1];
$_SESSION['precio_costo'][$i]=$_SESSION['precio_costo'][$i+1];

$posicion++;
}
}else if($posicion>0){
$_SESSION['tablaProducto'][$i]=$_SESSION['tablaProducto'][$i+1];		
$_SESSION['cantidad'][$i]=$_SESSION['cantidad'][$i+1]; 
$_SESSION['precio_costo'][$i]=$_SESSION['precio_costo'][$i+1];
 
}else{
  
}
}else{
	$_SESSION['contadorProducto']=$_SESSION['contadorProducto']-1;
}

}

    echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Costo</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("select * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
    while($fila=mysqli_fetch_array($consulta)){
     echo "<tr><td>".$fila['codigo'].".</td>
     <td>".$fila['nombre_producto'].".</td>
     <td><input style='background-color:transparent;' class='form-control' type='number' step='0.01' value='".$fila['precio_costo']."' min='0' onchange='modificar_precio_costo($i,this);' onclick='modificar_precio_costo($i,this);' onkeyup='modificar_precio_costo($i,this);'></td>
      <td><input style='background-color:transparent;' class='form-control' type='number' value='".$_SESSION['cantidad'][$i]."' min='1' onchange='modificarCantidadCarrito($i,this);' onclick='modificarCantidadCarrito($i,this);' onkeyup='modificarCantidadCarrito($i,this);'></td>
      <td class='text-center'>

 <span title='eliminar' ".'class="btn btn-danger btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='eliminar_elemento_entrada(\"".$_SESSION['tablaProducto'][$i]."\",$i)' >
  <span class='fa fa-times'></span>
 </span>
 </td>
 </tr>";
 
    }
    }
 
   
    echo "</table>";


?>