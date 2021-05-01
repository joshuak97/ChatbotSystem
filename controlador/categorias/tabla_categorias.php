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
                    <th>N°</th>
                    <th>Categoria</th>
                    <th>Opciones</th>
                 </thead>
                  <tfoot>
                    <th>N°</th>
                    <th>Categoria</th>
                    <th>Opciones</th>
                 </tfoot></tfoot>
                  
                  <tbody>
                    <?php
                    $count=1;
                 $consul_categorias=  ejecutarSQL::consultar("SELECT * FROM categorias");
                 while ($categorias=mysqli_fetch_array($consul_categorias)){
                 echo "<tr>
                 <td>".$count."</td>
                 <td>".$categorias['nombre_categoria']."</td><td>";
                 $count++;
                 ?>
                  <button class='btn btn-sm btn-warning' onclick="editar_categoria(<?php echo $categorias['id_categoria'].",'".$categorias['nombre_categoria']."'";?>);"><span class='fa fa-edit'></span></button>

                 <?php
                 echo "<button class='btn btn-sm btn-danger' onclick='eliminar_categoria(".$categorias['id_categoria'].");'><span class='fa fa-times'></span></button>
                 </td>
                 </tr>";
                 }
                 ?> 
                  </tbody>
                  

                </table>