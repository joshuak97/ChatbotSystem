

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Proveedores</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3 form-inline">
              <div class="col-md-10"><h6 class="m-0 font-weight-bold text-primary">Almacene la información de sus empleados al mismo tiempo que les crea su acceso al sistema.</h6></div><div class="col-md-2"><a class="btn btn-success float-right d-none d-sm-none d-md-block" style="color: white; text-align: right;" data-toggle="modal" data-target="#modal_agregar_proveedor"><i class="fa fa-plus"></i>  Nuevo proveedor</a>
              <a class="btn btn-success btn-circle float-right d-block d-sm-block d-md-none" style="color: white; text-align: right;"><i class="fa fa-plus"></i></a>
              </div>
            </div>
            <div class="card-body">
              <div id="res-form-eliminar-proveedor">
                <?php
                if (isset($_GET['alert'])) {
                  switch ($_GET['alert']) {
                    case 1:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede eliminar.</h5></div>
                      <p class='text-center'>Existen productos o entradas registradas de este proveedor.</p>
                      </div>";
                      break;
                      case 2:
                      echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>El proveedor ha sido eliminado.</h5></div>
                    
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
              <div class="table-responsive" id="tabla_proveedores">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                 
                  <thead>
                    <th>Proveedor</th>
                    <th>RFC</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Opciones</th>
                 </thead>
                  <tfoot>
                    <th>Proveedor</th>
                    <th>RFC</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Opciones</th>
                 </tfoot></tfoot>
                  
                  <tbody>
                    <?php
                 $consul_proveedores=  ejecutarSQL::consultar("SELECT * FROM proveedor WHERE id_sucursal=".$_SESSION['id_sucursal']);
                 while ($proveedores=mysqli_fetch_array($consul_proveedores)){
                 echo "<tr>
                 <td>".$proveedores['nombre_proveedor']."</td>
                 <td>".$proveedores['rfc_proveedor']."</td>
                 <td>".$proveedores['direccion_proveedor']."</td>
                 <td>".$proveedores['telefono_proveedor']."</td>
                 <td>".$proveedores['correo_proveedor']."</td>
                 <td>";
                 ?>
                  <button class='btn btn-sm btn-warning' onclick="editar_proveedor(<?php echo $proveedores['id_proveedor'].",'".$proveedores['nombre_proveedor']."','".$proveedores['rfc_proveedor']."','".$proveedores['direccion_proveedor']."','".$proveedores['telefono_proveedor']."','".$proveedores['correo_proveedor']."',".$proveedores['id_sucursal'];?>);"><span class='fa fa-edit'></span></button>

                 <?php
                 echo "<button class='btn btn-sm btn-danger' onclick='eliminar_proveedor(".$proveedores['id_proveedor'].");'><span class='fa fa-times'></span></button>
                 </td>
                 </tr>";
                 }
                 ?> 
                  </tbody>
                  

                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

<!--********************************** MODAL AGREGAR PROVEEDOR *********************************************************** -->

<div class="modal fade" id="modal_agregar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/proveedores/agregar_proveedor.php" method="post" id="form_agregar_proveedor">
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

<!--*************************************************MODAL EDITAR PROVEEDOR**************************************************-->


<div class="modal fade" id="modal_editar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/proveedores/editar_proveedor.php" method="post" id="form_editar_proveedor">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body"><!--Begin body-->
      <div class="text-center" id="res-form-editar-proveedor"></div>
      <input type="hidden" name="id_proveedor" id="id_proveedor" required="">
      <div class="form-group"> 
      <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control" placeholder="Nombre del proveedor" required="">
      </div> 
      <div class="form-group"> 
      <input type="text" name="rfc_proveedor" id="rfc_proveedor" class="form-control" placeholder="RFC del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="direccion_proveedor" id="direccion_proveedor" class="form-control" placeholder="Dirección del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="telefono_proveedor" id="telefono_proveedor" class="form-control" placeholder="Telefono del proveedor (Opcional)">
      </div> 
      <div class="form-group"> 
      <input type="text" name="correo_proveedor" id="correo_proveedor" class="form-control" placeholder="Correo del proveedor (Opcional)">
      </div>
      <input type="hidden" name="id_sucursal" id="id_sucursal" required="">
     
      </div><!--End body-->
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>

      </div>
    </form>
      
    </div>
    
  </div>
</div>

<!--************************************************MODAL ELIMINAR PROVEEDOR*********************************************-->
  <div class="modal fade" id="modal_eliminar_proveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/proveedores/eliminar_proveedor.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar a este proveedor?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_proveedor" id="id_proveedor_e" value="">
        <div class="modal-body">Seleccione eliminar para confirmar la operación.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="confirmar_eliminar_proveedor();">Eliminar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
