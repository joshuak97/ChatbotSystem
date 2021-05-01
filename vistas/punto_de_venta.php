<?php
$_SESSION['contadorProducto']=0;
$_SESSION['cantidad']=array();
$_SESSION['tablaProducto']=array();
$_SESSION['sumaTotal']=0;
?>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Punto de Venta</h1>
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
           <div class="card-header py-3 form-inline">
            <div class="col-md-10 form-group"> 
              <input type="text" class="form-control" style="width: 100%;" id="txtcodigo" placeholder="Introduzca codigo del producto"></div>
            <div class="col-md-2 text-center form-group">
              <a class="btn btn-info btn-circle" data-toggle="modal" title="Consultar productos" data-target="#modal-consultar-productos" style="color: white;"><i class="fa fa-search" ></i></a>
              &nbsp;<a class="btn btn-warning btn-circle" style="color: white;"><i class="fa fa-barcode"></i></a>
              &nbsp;<a class="btn btn-danger btn-circle" data-toggle="modal" data-target="#modal_cancelar_venta" title="Cancelar venta" style="color: white;background: orange;"><i class="fa fa-ban"></i></a>
              &nbsp;<a  data-toggle="modal" data-target="#modal_corte_caja" class="btn btn-danger btn-circle" title="Corte de caja" style="color: white;background: red;"><i class="fa fa-calculator"></i></a>
            </div>  
           
            </div>
            <div class="card-body">
              <div class="table-responsive" id="tabla_carrito">



                <table class="table table-bordered text-center"  width="100%" cellspacing="0">
            
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                 
                  <tr><td>Subtotal:</td><td id="mostrar-subtotal">$0.00</td><td></td><td></td><td></td></tr>
                  </tbody>
                </table>
              </div>
              <div id="res-venta"></div>
               <div class="form-group">
                <label>Forma de pago:</label>
                <select id="id_pago" class="form-control" onchange="forma_pago(this);">
                  <option value="1">Efectivo</option>
                  <option value="2">Tarjeta de Debito</option>
                  <option value="3">Tarjeta de Credito</option>
                </select>
              </div>
              
              <div class="form-group" id="forma_pago">
                <label>Importe:</label>
              <input class="form-control" type="number" step="0.01" id="importe" placeholder="$0.00" min="0.00">
              </div>

              <div class="form-group col-md-12 text-center"><a class="btn btn-success btn-lg col-md-2" onclick="vender();" style="color: white;"><i class="fa fa-shopping-cart" ></i> Vender</a>&nbsp;&nbsp;<a onclick="window.location.reload();" class="btn btn-danger btn-lg col-md-2" style="color: white;"><i class="fa fa-eraser" ></i> Cancelar</a></div>
             
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
          <!-- Modal -->
<div class="modal fade" id="modal-consultar-productos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Consultar Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Introduce codigo, marca o nombre del producto" onkeyup="consultar_productos(this);">
        </div>
        <div class="table-responsive" id="tabla-consultar-producto">
        <table class="table-bordered text-center" style="width: 100%">
        <tr><td>Producto</td><td>Cantidad</td><td>Precio</td><td>Agregar</td> </tr>   
    
       
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <div class="text-center"> <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button></div>
       
    
      </div>
    </div>
  </div>
</div>
  <!-- Modal  venta realizada-->
<div class="modal fade" id="modal_venta_realizada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLabel">¡Correcto!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="mostrar_ticket"></div>
        
      </div>
      <div class="modal-footer">
        <div id="mostrar_cambio"></div>
        <div class="text-center"> <button type="button" class="btn btn-primary" data-dismiss="modal">Finalizar</button></div>
       
    
      </div>
    </div>
  </div>
</div>


<!-- Modal  abrir caja-->
<div class="modal fade" id="modal_abrir_caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLabel">Abrir Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="controlador/punto_de_venta/abrir_caja.php" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label>Fondo</label>
       <input type="number" class="form-control" step="0.01" name="fondo" placeholder="$0.00">
        </div>
      </div>
      <div class="modal-footer">
        
        <div class="text-center"> 
          <button type="submit" class="btn btn-success">Abrir</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button></div>
       
    </form>
      </div>
    </div>
  </div>
</div>



<!-- Modal  corte de caja-->
<div class="modal fade" id="modal_corte_caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLabel">Corte de Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        <p>¿Desea realizar corte de caja?</p>
        </div>
      </div>
      <div class="modal-footer">
        
        <div class="text-center"> 
          <a  class="btn btn-success" href="tcpdf/pdf/corte_caja.php" target="_blank">Si</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button></div>

      </div>
      <div id="res-corte-caja"></div>
    </div>
  </div>
</div>


<!-- Modal  abrir caja-->
<div class="modal fade" id="modal_editar_precio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="text-align: center;">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLabel">Editar precio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <input type="hidden"  id="id_producto">
        <div class="form-group" id="precio_venta_con">
          <label>Precio de venta</label>
       <input type="number" class="form-control" step="0.01" id="precio_venta" placeholder="$0.00">
        </div>
      </div>
      <div class="modal-footer">
        
        <div class="text-center"> 
          <button type="submit" class="btn btn-success" onclick="guardar_precio();">Guardar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button></div>
       <div id="res_editar_precio"></div>
   
      </div>
    </div>
    <
  </div>
</div>



<!--************************************************MODAL CANCELAR VENTA*********************************************-->
  <div class="modal fade" id="modal_cancelar_venta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="controlador/punto_de_venta/cancelar_venta.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Desea cancelar alguna venta?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div id="res_cancelar_venta"></div>
        <div class="modal-body">

          <div class="form-group">
            <input type="text" name="folio_venta" id="txt_cancelar_venta" class="form-control" placeholder="Introduzca folio de venta">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-danger">Cancelar venta</button>
        </div>
      </form>
      </div>
    </div>
  </div>