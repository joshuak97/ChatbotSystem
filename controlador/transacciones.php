

<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "pharma_system");

if ($mysqli->connect_errno) {
    printf("Conexión fallida: %s\n", $mysqli->connect_error);
    exit();
}


?>