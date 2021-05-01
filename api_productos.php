<?php
include "api.php";
$sql="SELECT*FROM productos inner join categoria on producto.id_categoria=categoria.id_categoria";
        
        $myArray = getArraySQL($sql);
        echo json_encode($myArray);


?>