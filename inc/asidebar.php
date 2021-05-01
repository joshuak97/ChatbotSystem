 <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php?modulo=dashboard">
        <div class="sidebar-brand-icon" style="padding: 10%">
         <img src="img/logo.png" style="width: 80%;">
        </div>
        <div class="sidebar-brand-text mx-3"><sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item"  onclick="cargarVistas('dashboard');">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Administración
      </div>

      <!-- Nav Item -Ventas Collapse Menu -->
      <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Ventas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a href="#" class="collapse-item" onclick="cargarVistas('ventas_realizadas');">Ventas Realizadas</a>
            <a href="#" class="collapse-item"  onclick="cargarVistas('ventas_canceladas');">Ventas Canceladas</a>
             <a href="#" class="collapse-item" onclick="cargarVistas('cortes_caja');">Cortes de Caja</a>
          </div>
        </div>
      </li>-->

 <!-- Nav Item - Empleados -->
   <!--   <li class="nav-item"  onclick="cargarVistas('empleados');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-users"></i>
          <span>Empleados</span></a>
      </li>
-->
       <!-- Nav Item - Sucursal -->
    <!--  <li class="nav-item"  onclick="cargarVistas('sucursales');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-warehouse"></i>
          <span>Sucursal</span></a>
      </li>-->


        <!-- Nav Item - Categorias -->
      <li class="nav-item"  onclick="cargarVistas('inventario');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Productos</span></a>
      </li>

        <!-- Nav Item - Categorias -->
      <li class="nav-item"  onclick="cargarVistas('categorias');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-clipboard-list"></i>
          <span>Categorias</span></a>
      </li>
  <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     <!-- <div class="sidebar-heading">
        Ventas
      </div>

      <li class="nav-item"  onclick="cargarVistas('punto_de_venta');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Punto de Venta</span></a>
      </li>-->
      <!-- Divider -->
     <!-- <hr class="sidebar-divider">-->

      <!-- Heading -->
<!--      <div class="sidebar-heading">
        Facturación
      </div>-->

     
      <!-- Nav Item - Charts -->
      <!--<li class="nav-item"  onclick="cargarVistas('mis_facturas');">
        <a href="#" class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-folder"></i>
          <span>Mis Facturas</span></a>
      </li> -->

      <!-- Nav Item - Tables -->
    <!--  <li class="nav-item"  onclick="cargarVistas('clientes');">
        <a href="#" class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-user"></i>
          <span>Clientes</span></a>
      </li> -->

      <!-- Divider -->
     <!-- <hr class="sidebar-divider d-none d-md-block"> -->

      <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul> 
    <!-- End of Sidebar -->