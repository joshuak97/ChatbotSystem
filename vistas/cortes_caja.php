<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Cortes de Caja</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Utilize el campo buscar para encontrar las ventas que desee, en la columna "Opciones" usted puede aprovar o rechazar cancelaciones</h6>
            </div>
            <div class="card-body">
              <div>  <?php
                if (isset($_GET['alert'])){
                  switch ($_GET['alert']) {
                    case 1:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede eliminar.</h5></div>
                      <p class='text-center'>Ha ocurrido un error al realizar los cambios.</p>";
                      break;
                      case 2:
                      echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La cancelacion ha sido aprobada.</h5></div>
                    
                      </div>";
                      break;

                      case 3:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al aprobar la cancelacion, por favor intente de nuevo.</p>
                       </div>";
                      break;

                       case 4:
                      echo "<br><div class='alert alert-info alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La cancelacion ha sido rechazada.</h5></div>
                      ";
                      break;
                      case 5:
                      echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Error al rechazar la cancelacion.</h5></div>
                    
                      </div>";
                      break;

                     
                    
                    default:
                      
                      break;
                  }
                }
                ?></div>
                  <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>N°</th>
                      <th>Fecha</th>
                      <th>Realizó</th>
                      <th>Fondo</th>
                      <?php if($_SESSION['id_cargo']==1){ ?>    
                      <th>Sucursal</th>
                      <?php }?>
                      <th>Opciones</th>                   
                    
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>N°</th>
                      <th>Fecha</th>
                      <th>Realizó</th>
                      <th>Fondo</th>
                      <?php if($_SESSION['id_cargo']==1){ ?>    
                      <th>Sucursal</th>
                      <?php }?>
                      <th>Opciones</th>                   
                    
                    </tr>
                  </tfoot>
                  <tbody>
                   
                  <?php
                  $count=1;
                  if($_SESSION['id_cargo']>1){
                 $sql="SELECT * FROM caja inner join usuario on caja.id_usuario=usuario.id_usuario WHERE estado='cerrada' AND id_sucursal=".$_SESSION['id_sucursal'];
                 }else{
                 $sql="SELECT * FROM caja inner join usuario on caja.id_usuario=usuario.id_usuario inner join sucursal on usuario.id_sucursal=sucursal.id_sucursal WHERE estado='cerrada'";
                 }
                 $consul_ventas=  ejecutarSQL::consultar($sql);
                 while ($ventas=mysqli_fetch_array($consul_ventas)){
                 echo "<tr>
                 <td>".$count."</td>
                 <td>".$ventas['fecha_operacion']."</td>
                 <td>".$ventas['nombre_completo']."</td>
                 <td>".$ventas['fondo']."</td>";
                 if ($_SESSION['id_cargo']==1) {
                
                 echo "<td>".$ventas['nombre_sucursal']."</td>";
                 }
                 ?>
                 <td>
                  <button class='btn btn-sm btn-warning' onclick="reimprimir_corte(<?php echo $ventas['id_caja'];?>);"><span class='fa fa-list'></span></button>

                </td></tr>
            <?php
            $count++;
          }
            ?>
                   
                   
                   
               
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Venta 98787553436</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table-bordered text-center" style="width: 100%">
        <tr><td>Producto</td><td>Cantidad</td><td>Precio</td></tr>  
        <tr><td>Producto 1</td><td>1</td><td>$100.00.</td></tr>  
        <tr><td>producto 2</td><td>2</td><td>$200.00.</td></tr>    
        <tr><td>producto 3</td><td>3</td><td>$300.00.</td></tr>    
        <tr><td>Total:</td><td>$600.00</td><td></td></tr>
       
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
    
      </div>
    </div>
  </div>
</div>

     <!-- Modal -->
<div class="modal fade" id="modal_detalles_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles de venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive"  id="detalles_venta">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
    
      </div>
    </div>
  </div>
</div>



<!--************************************************MODAL RECHAZAR CANCELACION*********************************************-->
  <div class="modal fade" id="modal_rechazar_cancelacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/ventas_canceladas/rechazar_cancelacion.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea rechazar esta cancelación?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_cancelacion" id="id_cancelacion" value="">
        <div class="modal-body">Si la cancelacion ya ha sido aprobada, se descontarán las existencias de esta venta en el inventario.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-danger">Rechazar</button>
        </div>
      </form>
      </div>
    </div>
  </div>

  <!--************************************************MODAL APROBAR CANCELACION*********************************************-->
  <div class="modal fade" id="modal_aprobar_cancelacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/ventas_canceladas/aprobar_cancelacion.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea aprobar esta cancelación?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_cancelacion" id="id_cancelacion2" value="">
        <div class="modal-body">Si aprueba esta cancelacion las existencias de esta venta se devolveran al inventario.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-success">Aprobar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
