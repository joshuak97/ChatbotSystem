<?php
include "api.php";
$sql="SELECT*FROM categorias";
        
        $myArray = getArraySQL($sql);
        echo json_encode($myArray);
?>