<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Ventas Realizadas</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Utilize el campo buscar para encontrar las ventas que desee</h6>
            </div>
            <div class="card-body">
              <div>  <?php
                if (isset($_GET['alert'])){
                  switch ($_GET['alert']) {
                    case 1:
                      echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede eliminar.</h5></div>
                      <p class='text-center'>Ha ocurrido un error al cancelar esta venta.</p>";
                      break;
                      case 2:
                      echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La venta ha sido cancelada.</h5></div>
                    
                      </div>";
                      break;

                      case 3:
                       echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al Cancelar, por favor intente de nuevo.</p>
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
                      <th>Folio</th>
                      <th>Fecha</th>
                      <th>Total</th>
                      <th>Forma de pago</th>                      
                      <th>Realizó</th>
                      <?php if($_SESSION['id_cargo']<3){?>
                      <th>Opciones</th>
                      <?php }?>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Folio</th>
                      <th>Total</th>
                      <th>Fecha</th>                  
                      <th>Forma de pago</th>                      
                      <th>Realizó</th>
                      <?php if($_SESSION['id_cargo']<3){?>
                      <th>Opciones</th>
                      <?php }?>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                 $consul_ventas=  ejecutarSQL::consultar("SELECT * FROM venta inner join metodo_pago on venta.id_pago=metodo_pago.id_pago inner join usuario on venta.id_usuario=usuario.id_usuario WHERE status='REALIZADA' AND venta.id_sucursal=".$_SESSION['id_sucursal']);
                 while ($ventas=mysqli_fetch_array($consul_ventas)){
                 echo "<tr>
                 <td>".$ventas['folio_venta']."</td>
                 <td>".$ventas['fecha_venta']."</td>
                 <td>$".$ventas['total_venta']."</td>
                 <td>".$ventas['metodo_de_pago']."</td>
                 <td>".$ventas['nombre_completo']."</td>
                 ";
                 ?>
                 <td>
                  <button class='btn btn-sm btn-warning' onclick="detalles_venta(<?php echo $ventas['id_venta'].",'".$ventas['folio_venta']."'";?>);"><span class='fa fa-list'></span></button>

                 <?php
                 if($_SESSION['id_cargo']<3){
                 echo "<button class='btn btn-sm btn-danger' onclick='cancelar_venta(".$ventas['id_venta'].");'><span class='fa fa-times'></span></button>";
                }
                 echo "</td></tr>";
                
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


<!--************************************************MODAL CANCELAR VENTA*********************************************-->
  <div class="modal fade" id="modal_cancelar_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/ventas_realizadas/cancelar_venta.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea cancelar esta venta?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <input type="hidden" name="id_venta" id="id_venta" value="">
        <div class="modal-body">Seleccione "Cancelar venta" para confirmar la operación.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-danger">Cancelar venta</button>
        </div>
      </form>
      </div>
    </div>
  </div>
