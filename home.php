<!DOCTYPE html>
<html lang="en">

<?php include 'inc/head.php';?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
 <!-- Sidebar -->
   <?php include 'inc/asidebar.php'; ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
    <!-- Navbar -->
       <?php include 'inc/navbar.php';?> 
       <!-- End of Navbar -->
       <?php
//Se carga el contenido de la pagina de acuerdo al modulo solicitado meidante una variable $_GET;
if(isset($_GET['modulo'])){
if($_GET['modulo']=='ventas_realizadas'){
include './vistas/ventas_realizadas.php';
} else if ($_GET['modulo']=='ventas_canceladas') {
include './vistas/ventas_canceladas.php';
}elseif ($_GET['modulo']=='cortes_caja') {
include './vistas/cortes_caja.php';
}elseif ($_GET['modulo']=='ganancias') {
include './vistas/ganancias.php';
}else if ($_GET['modulo']=='inventario') {
include'./vistas/inventario.php';
}elseif ($_GET['modulo']=='punto_de_venta') {
include './vistas/punto_de_venta.php';
}else if($_GET['modulo']=='empleados'){
include './vistas/empleados.php';
}else if($_GET['modulo']=='sucursales'){
include './vistas/sucursales.php';
}else if($_GET['modulo']=='categorias'){
include './vistas/categorias.php';
}else if($_GET['modulo']=='ajustes'){
include './vistas/ajustes.php';
}elseif ($_GET['modulo']=='mis_facturas'){
include './vistas/mis_facturas.php';
}elseif ($_GET['modulo']=='clientes') {
include './vistas/clientes.php';
}elseif ($_GET['modulo']=='entradas_producto') {
include './vistas/entradas_producto.php';
}else{
 include './vistas/dashboard.php';   
}
}else{
include './vistas/dashboard.php';  
}
?>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
    <?php include 'inc/footer.php';?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="process/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

 <?php include 'inc/scripts.php';?>

</body>

</html>
