<?php
session_start();
include('../consulSQL.php');
    $validar=0;
  $concaja=ejecutarSQL::consultar("SELECT*FROM caja WHERE id_usuario='".$_SESSION['id_usuario']."' ORDER BY id_caja desc limit 1");
    $caja=mysqli_fetch_array($concaja);

    if($caja['estado']=='abierta'){
    $conProd=ejecutarSQL::consultar("SELECT*FROM producto WHERE id_producto=".$_POST['id_producto']); 
   
    $prods=mysqli_fetch_array($conProd);
   
    $existencias=$prods['existencia'];
    if($existencias>0){
    if($_POST['cantidad']<$existencias){
    $cantidad=$_POST['cantidad'];
    }else{
    $cantidad=$prods['existencia'];    
    }

    if($_SESSION['contadorProducto']>0){
    for($x=0;$x<$_SESSION['contadorProducto'];$x++){
    if( $_SESSION['tablaProducto'][$x]==$_POST['id_producto']){
    $validar=1;
    $auxiliar=$x;
    }
    }
    if($validar==0){
    $_SESSION['cantidad'][$_SESSION['contadorProducto']]=$cantidad;
    $_SESSION['tablaProducto'][$_SESSION['contadorProducto']] = $_POST['id_producto'];
    $_SESSION['contadorProducto']++;
    
    }else{
    
    }
    }else{
        $_SESSION['cantidad'][$_SESSION['contadorProducto']]=$cantidad;
        $_SESSION['tablaProducto'][$_SESSION['contadorProducto']] = $_POST['id_producto'];

        $_SESSION['contadorProducto']++;   
    }
    if($_SESSION['contadorProducto']>0){
    $suma=0;
    echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Precio</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("select * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
    while($fila=mysqli_fetch_array($consulta)){
     echo "<tr><td>".$fila['codigo'].".</td>
     <td>".$fila['nombre_producto'].".</td>
     <td> ".$fila['precio_venta']."</td>
      <td><input style='background-color:transparent;' class='form-control' type='number' value='".$_SESSION['cantidad'][$i]."' min='1' max='".$fila['existencia']."' <input type='number' value='".$_SESSION['cantidad'][$i]."' min='0' onchange='modificarCantidadCarrito($i,this);' onclick='modificarCantidadCarrito($i,this);' onkeyup='modificarCantidadCarrito($i,this);'></td>
      <td class='text-center'>
 <span title='eliminar' ".'class="btn btn-warning btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='editarElemento(\"".$_SESSION['tablaProducto'][$i]."\")' >
  <span class='fa fa-edit'></span>
 </span>

 <span title='eliminar' ".'class="btn btn-danger btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='eliminarElemento(\"".$_SESSION['tablaProducto'][$i]."\",$i)' >
  <span class='fa fa-times'></span>
 </span>
 </td>
 </tr>";
 $suma +=$fila['precio_venta']*$_SESSION['cantidad'][$i];
    }
    }
    $_SESSION['sumaTotal']=$suma;
    echo "<tr><td>Subtotal:</td><td id='mostrar-subtotal'>$".number_format($_SESSION['sumaTotal'],2)."</td><td></td><td></td><td></td></tr>";
    echo "</table>";

        
    
} 
}else{
$suma=0;
    echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Precio</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("select * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
    while($fila=mysqli_fetch_array($consulta)){
     echo "<tr><td>".$fila['codigo'].".</td>
     <td>".$fila['nombre_producto'].".</td>
     <td> ".$fila['precio_venta']."</td>
      <td><input style='background-color:transparent;' class='form-control' type='number' value='".$_SESSION['cantidad'][$i]."' min='1' max='".$fila['existencia']."' <input type='number' value='".$_SESSION['cantidad'][$i]."' min='0' onchange='modificarCantidadCarrito($i,this);' onclick='modificarCantidadCarrito($i,this);' onkeyup='modificarCantidadCarrito($i,this);'></td>
      <td class='text-center'>
 <span title='eliminar' ".'class="btn btn-warning btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='editarElemento(\"".$_SESSION['tablaProducto'][$i]."\")' >
  <span class='fa fa-edit'></span>
 </span>

 <span title='eliminar' ".'class="btn btn-danger btn-circle" '." value='".$_SESSION['tablaProducto'][$i]."' onclick='eliminarElemento(\"".$_SESSION['tablaProducto'][$i]."\",$i)' >
  <span class='fa fa-times'></span>
 </span>
 </td>
 </tr>";
 $suma +=$fila['precio_venta']*$_SESSION['cantidad'][$i];
    }
    }
    $_SESSION['sumaTotal']=$suma;
    echo "<tr><td>Subtotal:</td><td id='mostrar-subtotal'>$".number_format($_SESSION['sumaTotal'],2)."</td><td></td><td></td><td></td></tr>";
    echo "</table>";
}
  }else{
    echo "<script>$('#modal_abrir_caja').modal('show');</script>"; 
  }  

?>