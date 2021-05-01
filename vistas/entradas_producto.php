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
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">ENTRADAS DE MERCANCIA</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3 form-inline">
            <!--Botones visibles en escritorio-->
             <div class="col-md-4 d-none d-sm-none d-md-block"></div>
             <div class="col-md-8 d-none d-sm-none d-md-block">
              <a class="btn btn-warning float-right" style="color: white;margin: 1%"><i class="fa fa-file"></i>  Generar reporte</a>
              <a class="btn btn-info float-right" style="color: white;margin: 1%" data-toggle="modal" data-target="#modal_agregar_proveedor2"><i class="fa fa-truck"></i>  Proveedores</a>
              <a class="btn btn-success float-right" data-toggle="modal" data-target="#modal_agregar_entradas" style="color: white;margin: 1%"><i class="fa fa-arrow-down"></i>Nueva entrada</a>
              </div>
              <!--Botones visibles en movil-->
              <div class="col-md-12 d-block d-sm-block d-md-none text-center">
              <a class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_agregar_entradas" style="color: white; margin: 1%;"><i class="fa fa-truck"></i></a>
              <a class="btn btn-info btn-circle" style="color: white; margin: 1%;"><i class="fa fa-plus"></i></a> 
              <a class="btn btn-warning btn-circle" style="color: white; margin: 1%;"><i class="fa fa-plus"></i></a>
              <a class="btn btn-danger btn-circle" style="color: white; margin: 1%;"><i class="fa fa-plus"></i></a>
              </div>
           
            </div>
            <div class="card-body">
               <div id="res-form-eliminar-producto">
                <?php
                if (isset($_GET['alert'])) {
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
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La entrada de producto ha sido eliminada.</h5></div>
                    
                      </div>";
                      break;

                      case 3:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al eliminar, por favor intente de nuevo.</p>
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
                      <th>Folio</th>
                      <th>Fecha</th>
                      <th>Codigo P.</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Proveedor.</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tfoot>
                   <tr>
                      <th>Folio</th>
                      <th>Fecha</th>
                      <th>Codigo P.</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Proveedor.</th>
                      <th>Opciones</th>
                    </tr>
                  </tfoot>
                 
                  <tbody>
                 <?php
                 $consul_productos=  ejecutarSQL::consultar("SELECT * FROM entrada_producto inner join entrada on entrada.id_entrada=entrada_producto.id_entrada inner join proveedor on entrada.id_proveedor=proveedor.id_proveedor inner join producto on entrada_producto.id_producto=producto.id_producto where entrada.id_sucursal=".$_SESSION['id_sucursal']." ORDER BY id_ep DESC");
                 while ($productos=mysqli_fetch_array($consul_productos)){
                 echo "<tr>
                      <td>".$productos['folio_entrada']."</td>
                      <td>".$productos['fecha_entrada']."</td>
                      <td>".$productos['codigo']."</td>
                      <td>".$productos['nombre_producto']."</td>
                      <td>".$productos['cantidad']."</td>
                     
                      <td>".$productos['nombre_proveedor']."</td>
                      ";
                     echo "<td>";
                     //Validamos el acceso para mostrar las opciones
                      if($productos['archivo']!=""){?>
                      <button title="Comprobante de entrada" class='btn btn-sm btn-warning' onclick="detalles_entrada(<?php echo $productos['id_entrada'];?>);"><span class='fa fa-file'></span></button>
                      <?php
                      }else{
                        ?>
                         <button title="Cargar comprobante de entrada" class='btn btn-sm btn-success' onclick="detalles_entrada(<?php echo $productos['id_entrada'];?>);"><span class='fa fa-arrow-up'></span></button>
                      <?php
                      }
                      echo "<button class='btn btn-sm btn-danger' onclick='eliminar_entrada(".$productos['id_ep'].");'><span class='fa fa-times'></span></button>
                      </td>";
                    echo "</tr>";
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


  <!--************************************************MODAL AGREGAR ENTRADA DE PRODUCTO*********************************************-->
  <div class="modal fade" id="modal_agregar_entradas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <form action="controlador/productos/agregar_entradas_productos.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nueva Entrada de Producto</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_sucursal" value="<?php echo $_SESSION['id_sucursal']?>">
        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']?>">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="folio_entrada" class="form-control" placeholder="Folio de la nota o factura" required="">
          </div>
          <div class="form-group"> 
            <label>Fecha de entrada:</label>
          <input type="date" name="fecha_entrada" class="form-control" required="">
          </div>
          <div class="form-group">
      <label>Proveedor:</label>
      <select class="form-control" name="id_proveedor" id="select-proveedores" required="">
      <option selected="" value="">Seleccione una opción</option>
      <?php
       $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM proveedor");
       while ($proveedores=mysqli_fetch_array($consul_proveedores)){
       echo '<option value="'.$proveedores['id_proveedor'].'">'.$proveedores['nombre_proveedor'].'</option>';
       }
      ?>
      </select>
      </div>
      <div class="form-group"> 
            <label>Foto o archivo de la nota o factura (opcional):</label>
          <input type="file" name="archivo" class="form-control">
          </div>

          <div class="form-group"> 
            <label>Seleccione los productos a ingresar:</label>
          <input type="text" id="txtcodigo_entradas" onkeyup="consultar_productos_entrada(this);" class="form-control" placeholder="ingrese codigo o nomre del producto">
          </div>
          <div id="tabla_productos_entrada" id="table-responsive"></div>
          <div class="form-group"><label>Lista de productos:</label></div>
          <div id="tabla_entradas" class="table-responsive">
          <table class="table table-bordered">
          <tr><td>Codigo</td><td>Articulo</td><td>Costo</td><td>Cantidad</td><td>Eliminar</td></tr>
        </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <div class="res-entradas"></div>
        </div>
      </form>
      </div>
    </div>
  </div>

  

  

  




<!--************************************************MODAL ELIMINAR ENTRADA*********************************************-->
  <div class="modal fade" id="modal_eliminar_entrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/entrada_productos/eliminar_entrada.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar a esta entrada de producto?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_entrada" id="id_entrada" value="">
        <div class="modal-body">Seleccione eliminar para confirmar la operación.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="confirmar_eliminar_entrada();">Eliminar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
<!--********************************** MODAL AGREGAR PROVEEDOR *********************************************************** -->

<div class="modal fade" id="modal_agregar_proveedor2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/proveedores/agregar_proveedor.php" method="post" id="form_agregar_proveedor2">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body"><!--Begin body-->
      <div class="text-center" id="res-form-agregar-proveedor"></div>
      <div class="form-group"> 
      <input type="text" name="nombre_proveedor" class="form-control" placeholder="Nombre del proveedor" required="">
      </div> 
      <div class="form-group"> 
      <input type="text" name="rfc_proveedor" class="form-control" placeholder="RFC del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="direccion_proveedor" class="form-control" placeholder="Dirección del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="telefono_proveedor" class="form-control" placeholder="Telefono del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="correo_proveedor" class="form-control" placeholder="Correo del proveedor (Opcional)">
      </div>
      <input type="hidden" name="id_sucursal" value="<?php echo $_SESSION['id_sucursal'];?>" required="">
     
      </div><!--End body-->
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Agregar</button>

      </div>
    </form>
      
       

    
    </div>
    
  </div>
</div>
