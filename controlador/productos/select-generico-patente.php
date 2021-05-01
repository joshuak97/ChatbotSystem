<?php 
 session_start();
 include '../consulSQL.php';

 if($fila['generico_patente']=='generico'){
 echo'<option value="generico">Generico</option>
 <option value="patente">Patente</option>';
 }else{
 echo'<option value="patente">Patente</option>
 <option value="generico">Generico</option>';
 }

 ?>
 
