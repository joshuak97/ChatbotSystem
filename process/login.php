<?php
session_start();
sleep(2);

include '../controlador/consulSQL.php';



if(!$_POST['user']=="" &&  !$_POST['password']==""){
    $nombre=$_POST['user'];
    $clave=md5($_POST['password']);
    $verUser=ejecutarSQL::consultar("select * from usuario where user='$nombre' and password='$clave'");
    $UserC=mysqli_num_rows($verUser);
    if($UserC>0){
        $acceso=mysqli_fetch_array($verUser);
        $_SESSION['nombre_completo']=$acceso['nombre_completo'];
       
        
        
        $_SESSION['id_usuario']=$acceso['id_usuario'];
    
    
        
        echo '<script> window.location.href="home.php";</script>';
    }else{
        echo "<br><div class='alert alert-danger alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <div class='text-center'><h4>  <i class='fa-window-close-o'></i> Error!!</h4></div>
        Usuario o contraseña incorrectos, verifique su informacion.
        </div>"; 
    }
}else{
echo "<br><div class='alert alert-danger alert-dismissable'>
<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
<h4>  <i class='icon fa-window-close-o'></i> Error!!</h4>
Los campos no deben estar vacios.
</div>";    

}
?>