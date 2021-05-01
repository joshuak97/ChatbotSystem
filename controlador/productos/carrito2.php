<?php
session_start();
include('../consulSQL.php');
    $validar=0;
 

    $conProd=ejecutarSQL::consultar("SELECT*FROM producto WHERE codigo='".$_POST['codigo']."'"); 
    $num=mysqli_num_rows($conProd);
    if($num>0){
    $prods=mysqli_fetch_array($conProd);
    $id_producto=$prods['id_producto'];
   if($_SESSION['contadorProducto']>0){
    for($x=0;$x<$_SESSION['contadorProducto'];$x++){
    if( $_SESSION['tablaProducto'][$x]==$prods['id_producto']){
    $validar=1;
    $auxiliar=$x;
    }
    }
    if($validar==0){
    $_SESSION['cantidad'][$_SESSION['contadorProducto']]=$_POST['cantidad'];
    $_SESSION['tablaProducto'][$_SESSION['contadorProducto']] = $prods['id_producto'];
    $_SESSION['precio_costo'][$_SESSION['contadorProducto']] = $prods['precio_costo'];
    $_SESSION['contadorProducto']++; 
    
    }else{
    
    }
    }else{
        
    $_SESSION['cantidad'][$_SESSION['contadorProducto']]=$_POST['cantidad'];
    $_SESSION['tablaProducto'][$_SESSION['contadorProducto']] = $prods['id_producto'];
    $_SESSION['precio_costo'][$_SESSION['contadorProducto']] = $prods['precio_costo'];
    $_SESSION['contadorProducto']++;  
    }

     
    
    if($_SESSION['contadorProducto']>0){

    echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Costo</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("select * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
    while($fila=mysqli_fetch_array($consulta)){
     echo "<tr><td>".$fila['codigo'].".</td>
     <td>".$fila['nombre_producto'].".</td>
     <td><input style='background-color:transparent;' class='form-control' type='number' step='0.01' value='".$fila['precio_costo']."' min='0' onchange='modificar_precio_costo($i,this);' onclick='modificar_precio_costo($i,this);' onkeyup='modificar_precio_costo($i,this);'></td>
      <td><input style='background-color:transparent;' class='form-control' type='number' value='".$_SESSION['cantidad'][$i]."' min='1' 
      min='1' onchange='modificarCantidadCarrito($i,this);' onclick='modificarCantidadCarrito($i,this);' onkeyup='modificarCantidadCarrito($i,this);'></td>
      <td class='text-center'>

 <span title='eliminar' ".'class="btn btn-danger btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='eliminar_elemento_entrada(\"".$_SESSION['tablaProducto'][$i]."\",$i)' >
  <span class='fa fa-times'></span>
 </span>
 </td>
 </tr>";
 
    }
    }
 
   
    echo "</table>";

        
    
} 

}else{

   echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Costo</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("select * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
    while($fila=mysqli_fetch_array($consulta)){
     echo "<tr><td>".$fila['codigo'].".</td>
     <td>".$fila['nombre_producto'].".</td>
     <td><input style='background-color:transparent;' class='form-control' type='number' step='0.01' value='".$fila['precio_costo']."' min='0' onchange='modificar_precio_costo($i,this);' onclick='modificar_precio_costo($i,this);' onkeyup='modificar_precio_costo($i,this);'></td>
      <td><input style='background-color:transparent;' class='form-control' type='number' value='".$_SESSION['cantidad'][$i]."' min='1' 
      min='1' onchange='modificarCantidadCarrito($i,this);' onclick='modificarCantidadCarrito($i,this);' onkeyup='modificarCantidadCarrito($i,this);'></td>
      <td class='text-center'>

 <span title='eliminar' ".'class="btn btn-danger btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='eliminar_elemento_entrada(\"".$_SESSION['tablaProducto'][$i]."\",$i)' >
  <span class='fa fa-times'></span>
 </span>
 </td>
 </tr>";

}
}

    }   

?>