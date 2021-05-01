<?php
session_start();
include('../consulSQL.php');
$_SESSION['precio_costo'][$_POST['posicion']]=$_POST['precio_costo'];


?>