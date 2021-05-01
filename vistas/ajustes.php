

<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Ajustes</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3 form-inline">
              <div class="col-md-10"></div><div class="col-md-2">
              
              </div>
            </div>
            <div class="card-body">
              <div id="res-form-eliminar-categoria">
                <?php
                if (isset($_GET['alert'])) {
                  switch ($_GET['alert']) {
                    case 1:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Incorrecto.</h5></div>
                      <p class='text-center'>Las nuevas contraseñas no coinciden.</p>
                      </div>";
                      break;
                      case 2:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La contraseña actual es incorrecta.</h5></div>
                    
                      </div>";
                      break;

                      case 3:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al cambiar contraseña, por favor intente de nuevo.</p>
                       </div>";
                      break;

                      case 4:
                       echo "<br><div class='alert alert-success alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Correcto.</h5></div>
                       <p class='text-center'>Contraseña Actualizada.</p>
                       </div>";
                      break;
                    
                    default:
                      
                      break;
                  }
                }
                ?>
              </div>
              
              <form action="controlador/ajustes/cambiar_password.php" method="post">
                
                <div class="form-group">
                  <label>Contraseña Actual</label>
                  <input type="password" name="actual_password" class="form-control">
                </div>
                 <div class="form-group">
                  <label>Nueva contraseña:</label>
                  <input type="password" name="nuevo_password" class="form-control">
                </div>
                 <div class="form-group">
                  <label>Confirmar nueva contraseña</label>
                  <input type="password" name="confirmar_password" class="form-control">
                </div>
                <div class="form-group">
                 <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
              </form>
              
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

<!--********************************** MODAL AGREGAR categoria *********************************************************** -->

<div class="modal fade" id="modal_agregar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/Ajustes/agregar_categoria.php" method="post" id="form_agregar_categoria">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar categoria</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body"><!--Begin body-->
      <div class="text-center" id="res-form-agregar-categoria"></div>
      <div class="form-group"> 
      <input type="text" name="nombre_categoria" class="form-control" placeholder="Nombre del categoria" required="">
      </div>      
      </div><!--End body-->
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Agregar</button>

      </div>
    </form>
      
       

    
    </div>
    
  </div>
</div>

<!--*************************************************MODAL EDITAR categoria**************************************************-->


<div class="modal fade" id="modal_editar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 

     <form action="controlador/Ajustes/editar_categoria.php" method="post" id="form_editar_categoria">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
     
      <div class="modal-body"><!--Begin body-->
      <div class="text-center" id="res-form-editar-categoria"></div>
      <input type="hidden" name="id_categoria" id="id_categoria" required="">
      <div class="form-group"> 
      <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" placeholder="Nombre del categoria" required="">
      </div>      
      </div><!--End body-->
       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>

      </div>
    </form>
      
    </div>
    
  </div>
</div>

<!--************************************************MODAL ELIMINAR categoria*********************************************-->
  <div class="modal fade" id="modal_eliminar_categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/ajustes/eliminar_categoria.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar a este categoria?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_categoria" id="id_categoria_e" value="">
        <div class="modal-body">Seleccione eliminar para confirmar la operación.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" onclick="confirmar_eliminar_categoria();">Eliminar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
