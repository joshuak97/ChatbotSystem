<?php 
 session_start();
 include '../consulSQL.php';
 ?>
   <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
     <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                     
                     
                      <th>Precio</th>
                      <th>Categorias</th>
                      <th>Reelevancia</th>
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
                       <td>".$productos['reelevancia']."</td>";

                     
                     //Validamos el acceso para mostrar las opciones
                      echo "<td>";?>
                      <button class='btn btn-sm btn-warning' onclick="editar_producto(<?php echo $productos['id_producto'];?>);"><span class='fa fa-edit'></span></button>
                      <?php
                      echo "<button class='btn btn-sm btn-danger' onclick='eliminar_producto(".$productos['id_producto'].");'><span class='fa fa-times'></span></button>
                      </td>";
                    echo "</tr>";
                 }

                 ?>
                   
             
                  </tbody>
                </table>