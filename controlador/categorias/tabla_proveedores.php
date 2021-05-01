 <?php 
 session_start();
 include '../consulSQL.php';
 ?>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

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