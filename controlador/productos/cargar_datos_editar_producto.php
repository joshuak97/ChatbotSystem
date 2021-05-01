<?php
include('../consulSQL.php');

$consulta=ejecutarSQL::consultar("SELECT*FROM productos where id_producto=".$_POST['id_producto']);
    while($fila=mysqli_fetch_array($consulta)){
?>
<input type="hidden" name="id_producto" value="<?php echo $fila['id_producto'];?>" id="id_producto" required="">
<div class="form-group">
      <label>Codigo:</label>
      <input type="text" name="codigo" id="codigo" class="form-control" value="<?php echo $fila['codigo'];?>" placeholder="Codigo de producto" required="">
      </div> 
    
      <div class="form-group"> 
      <label>Descripcion</label>
      <textarea type="text" name="nombre_producto" id="nombre_producto" class="form-control" placeholder="Descripcion del producto" required=""><?php echo $fila['nombre_producto'];?></textarea> 
      </div> 
     
     
      <div class="form-group"> 
      <label>Precio de venta:</label>
      <input type="number" step="0.01" name="precio_venta" id="precio_venta" value="<?php echo $fila['precio_venta'];?>" class="form-control" placeholder="$0.00" required="">
      </div>
      <div class="form-group">
      <label>Categoria:</label>
      <select class="form-control" name="id_categoria"  id="id_categoria" required="">
 
      <?php 
 
  $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias WHERE id_categoria=".$fila['id_categoria']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_categoria'].'">'.$proveedores['nombre_categoria'].'</option>';
       }
 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias WHERE id_categoria!=".$fila['id_categoria']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_categoria'].'">'.$proveedores['nombre_categoria'].'</option>';
       }

 ?>
      </select>
      </div>

 <div class="form-group">
      <label>Reelevancia:</label>
      <select class="form-control" name="id_reelevancia"  id="id_reelevancia" required="">
 
      <?php 
 
  $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM reelevancia WHERE id_reelevancia=".$fila['id_reelevancia']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_reelevancia'].'">'.$proveedores['reelevancia'].'</option>';
       }
 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM reelevancia WHERE id_reelevancia!=".$fila['id_reelevancia']);
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_reelevancia'].'">'.$proveedores['reelevancia'].'</option>';
       }

 ?>
      </select>
      </div>

      <div class="form-group"> 
      <label>Enlace</label>
      <input type="text" name="link" class="form-control" value="<?php echo $fila['link'];?>" required="">
      </div>

      <div class="form-group"> 
      <label>Imagen:</label>
      <input type="file" name="img" class="form-control" >
      </div>

      <?php
       
    }
?>

