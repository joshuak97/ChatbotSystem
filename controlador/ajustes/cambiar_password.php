<?php
session_start();
include "../consulSQL.php";

if($_POST['nuevo_password']==$_POST['confirmar_password']){
$actual_password=md5($_POST['actual_password']);
$nuevo_password=md5($_POST['nuevo_password']);
 $consul_user=  ejecutarSQL::consultar("SELECT * FROM usuario WHERE id_usuario=".$_SESSION['id_usuario']." AND password='$actual_password'");
 $num=mysqli_num_rows($consul_user);
 if($num>0){
if(consultasSQL::UpdateSQL("usuario", "password='$nuevo_password'", "id_usuario=".$_SESSION['id_usuario'])){
header("Location: ../../home.php?modulo=ajustes&alert=4"); 
}else{
header("Location: ../../home.php?modulo=ajustes&alert=3"); 
 } 
}else{
header("Location: ../../home.php?modulo=ajustes&alert=2"); 
 }
}else{
header("Location: ../../home.php?modulo=ajustes&alert=1"); 
}
?>