<?php
$_SESSION['contadorProducto']=0;
$_SESSION['cantidad']=array();
$_SESSION['precio_costo']=array();
$_SESSION['tablaProducto']=array();

?>
 <script>
    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
        if(e.keyCode == 13) {
          e.preventDefault();
        }
      }))
    });
  </script>
<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
    <link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">PRODUCTOS</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3 form-inline">
            <!--Botones visibles en escritorio-->
             <div class="col-md-4 d-none d-sm-none d-md-block"></div>
             <div class="col-md-8 d-none d-sm-none d-md-block">
         
             
              
              <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_agregar_entradas">Nueva entrada de productos</a>
                      <a class="dropdown-item" href="home.php?modulo=entradas_producto">Ver todas las entradas</a>
                     
                    </div>
              <a class="btn btn-success float-right" data-toggle="modal" data-target="#modal_agregar_producto" style="color: white;margin: 1%"><i class="fa fa-plus"></i>  Nuevo producto</a>
              </div>
              <!--Botones visibles en movil-->
              <div class="col-md-12 d-block d-sm-block d-md-none text-center">
              <a class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_agregar_producto" style="color: white; margin: 1%;"><i class="fa fa-plus"></i></a>
            
             
           
              </div>
           
            </div>
            <div class="card-body">
               <div id="res-form-eliminar-producto">
                <?php
                if (isset($_GET['alert'])){
                  switch ($_GET['alert']) {
                    case 1:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede eliminar.</h5></div>
                      <p class='text-center'>Existen entradas o salidas registradas de este producto.</p>";
                      break;
                      case 2:
                      echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>El producto ha sido eliminado.</h5></div>
                    
                      </div>";
                      break;

                      case 3:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al eliminar, por favor intente de nuevo.</p>
                       </div>";
                      break;

                       case 4:
                       echo "<br><div class='alert alert-success alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Correcto.</h5></div>
                       <p class='text-center'>Se ha registrado un nuevo producto con exito.</p>
                       </div>";
                      break;
                       case 5:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Error.</h5></div>
                       <p class='text-center'>Este producto ya se encuentra registrado.</p>
                       </div>";
                      break;
                       case 6:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Debe cargar una imagen del producto.</p>
                       </div>";
                      break;
                       case 7:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al cargar la imagen del producto, favor de intentarlo nuevamente.</p>
                       </div>";
                      break;

                      case 8:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Solo se admiten imagenes en formato jpg o png.</p>
                       </div>";
                      break;

                      case 9:
                       echo "<br><div class='alert alert-success alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>¡Correcto!.</h5></div>
                       <p class='text-center'>La informacion se ha actualizado.</p>
                       </div>";
                      break;

                      case 10:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>¡Error!.</h5></div>
                       <p class='text-center'>Ha ocurrido un error, Favor de intentarlo de nuevo.</p>
                       </div>";
                      break;
                    
                    
                    default:
                      
                      break;
                  }
                }
                ?>
              </div>
              <div class="table-responsive" id="tabla_productos">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                     
                     
                      <th>Precio</th>
                      <th>Categorias</th>
                      <th>Reelevancia</th>
                      <th>Imagen</th>
                      <th>Enlace(Link)</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                     
                      <th>Precio</th>
                      <th>Categorias</th>
                      <th>Reelevancia</th>
                      <th>Imagen</th>
                      <th>Enlace(Link)</th>
                      <th>Opciones</th>
                    </tr>
                  </tfoot>
                 
                  <tbody>
                 <?php
                 $consul_productos=  ejecutarSQL::consultar("SELECT * FROM productos inner join categorias on productos.id_categoria=categorias.id_categoria inner join reelevancia on productos.id_reelevancia=reelevancia.id_reelevancia");
                 while ($productos=mysqli_fetch_array($consul_productos)){
                 echo "<tr>
                      <td>".$productos['codigo']."</td>
                      <td>".$productos['nombre_producto']."</td>
                      
                     <td>".$productos['precio_venta']."</td>
                      <td>".$productos['nombre_categoria']."</td>
                       <td>".$productos['reelevancia']."</td>
                       <td><img src='img/img_productos/".$productos['imagen']."' width='70' height='70'></td>
                       <td><a href='".$productos['link']."' target='_blank'>".$productos['link']."</a></td>";

                     
                     //Validamos el acceso para mostrar las opciones
                      echo "<td>";?>
                      <button class='btn btn-sm btn-warning' onclick="editar_producto(<?php echo $productos['id_producto'];?>);"><span class='fa fa-edit'></span></button>
                      <?php
                      echo "<button class='btn btn-sm btn-danger' onclick='eliminar_producto(".$productos['id_producto'].");'><span class='fa fa-times'></span></button>
                      </td>";                    echo "</tr>";
                 }

                 ?>
                   
             
                  </tbody>
                </table>
              </div>
              <div id="#res-venta"></div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->


<!--********************************** MODAL AGREGAR PRODUCTO *********************************************************** -->

<div class="modal fade" id="modal_agregar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/productos/agregar_producto.php" method="post" id="form_agregar_producto" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body"><!--Begin body-->
      
      <div class="form-group">
      <label>Codigo:</label>
      <input type="text" name="codigo"  class="form-control" placeholder="Codigo de producto" required="">
      </div> 
      
      <div class="form-group"> 
      <label>Descripcion</label>
      <textarea type="text" name="nombre_producto" class="form-control" placeholder="Descripcion del producto" required=""></textarea> 
      </div> 
      
     
     
      <div class="form-group"> 
      <label>Precio del producto:</label>
      <input type="number" step="0.01" name="precio_venta" class="form-control" placeholder="$0.00" required="">
      </div>
      <div class="form-group">
      <label>Categoria:</label>
      <select class="form-control" name="id_categoria"  required="">
      <option selected="" value="">Seleccione una opción</option>
      <?php
       $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM categorias");
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_categoria'].'">'.$proveedores['nombre_categoria'].'</option>';
       }
      ?>
      </select>
      </div>
      <div class="form-group">
      <label>Reelevancia:</label>
      <select class="form-control" name="id_reelevancia"  required="">
      <option selected="" value="">Seleccione una opción</option>
      <?php
       $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM reelevancia");
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_reelevancia'].'">'.$proveedores['reelevancia'].'</option>';
       }
      ?>
      </select>
      </div>
      <div class="form-group"> 
      <label>Enlace</label>
      <input type="text" name="link" class="form-control" required="">
      </div>

      <div class="form-group"> 
      <label>Imagen:</label>
      <input type="file" name="img" class="form-control" required="">
      </div>
      <input type="hidden" name="id_sucursal" value="<?php echo $_SESSION['id_sucursal'];?>" required="">
      <div class="text-center" id="res-form-agregar-producto"></div>
      </div><!--End body-->
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Agregar</button>
       
      </div>
    </form>
      
       

    
    </div>
    
  </div>
</div>

<!--*************************************************MODAL EDITAR PRODUCTO**************************************************-->


<div class="modal fade" id="modal_editar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/productos/editar_producto.php" method="post" id="form_editar_producto" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body" id="campos-editar-producto"><!--Begin body-->
      
      <input type="hidden" name="id_producto" id="id_producto" required="">
      <div class="form-group">
      <label>Codigo:</label>
      <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Codigo de producto" required="">
      </div> 
     
      <div class="form-group"> 
      <label>Descripcion</label>
      <textarea type="text" name="nombre_producto" id="nombre_producto" class="form-control" placeholder="Descripcion del producto" required=""></textarea> 
      </div> 
     
      <div class="form-group"> 
      <label>Precio de venta:</label>
      <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" placeholder="$0.00" required="">
      </div>
      <div class="form-group">
      <label>categorias:</label>
      <select class="form-control" name="id_categoria"  id="id_categoria" required="">
      
      </select>
      </div>

      <div class="form-group">
      <label>Reelevancia:</label>
      <select class="form-control" name="id_reelevancia"  id="id_reelevancia" required="">
      
      </select>
      </div>
     
       <div class="form-group"> 
      <label>Enlace</label>
      <input type="text" name="link" class="form-control" required="">
      </div>

      <div class="form-group"> 
      <label>Imagen:</label>
      <input type="file" name="img" class="form-control" required="">
      </div>
      </div><!--End body-->
       
      <div class="text-center" id="res-form-editar-producto"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>

      </div>
    </form>
      
    </div>
    
  </div>
</div>

<!--************************************************MODAL ELIMINAR producto*********************************************-->
  <div class="modal fade" id="modal_eliminar_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/productos/eliminar_producto.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar a este producto?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_producto" id="id_producto_e" value="">
        <div class="modal-body">Seleccione eliminar para confirmar la operación.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="confirmar_eliminar_producto();">Eliminar</button>
        </div>
      </form>
      </div>
    </div>
  </div>

