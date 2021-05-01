<?php
session_start();
include('../consulSQL.php');
  
    if($_SESSION['contadorProducto']>0){
    $suma=0;
    echo '<table class="table table-bordered">';
    echo '<tr><td>Codigo</td><td>Articulo</td><td>Precio</td><td>Cantidad</td><td>Eliminar</td></tr>';
    for($i=0;$i<$_SESSION['contadorProducto'];$i++){
    $consulta=ejecutarSQL::consultar("SELECT * from Producto where id_producto=".$_SESSION['tablaProducto'][$i]);
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
    echo "<tr><td>Subtotal:</td><td id='mostrar-subtotal'>$".number_format($_SESSION['sumaTotal'],2)."</td><td></td><td></td></tr>";
    echo "</table>";

        
    
} 
  
?>