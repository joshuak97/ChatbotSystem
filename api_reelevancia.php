<?php
include "api.php";
$sql="SELECT*FROM reelevancia";
        
        $myArray = getArraySQL($sql);
        echo json_encode($myArray);


?>