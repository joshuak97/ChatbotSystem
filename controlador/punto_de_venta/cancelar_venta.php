
<?php
session_start();
include "../consulSQL.php";
$consul=  ejecutarSQL::consultar("SELECT * FROM venta WHERE folio_venta='".$_POST['folio_venta']."'");
$res_consul=mysqli_fetch_array($consul);
if($res_consul['status']=='REALIZADA'){
$id_venta=$res_consul['id_venta'];
$validar=0;
if($_SESSION['id_cargo']<3){
$status='APROBADA';
$consul_productos=  ejecutarSQL::consultar("SELECT * FROM venta_producto WHERE id_venta=$id_venta");
while($producto_venta=mysqli_fetch_array($consul_productos)){
$id_producto=$producto_venta['id_producto'];
$consul_producto=  ejecutarSQL::consultar("SELECT * FROM producto WHERE id_producto=$id_producto");
$prods=mysqli_fetch_array($consul_producto);
$nuevo_stock=$prods['existencia']+$producto_venta['cantidad'];
if(!consultasSQL::UpdateSQL("producto", "existencia='$nuevo_stock'", "id_producto=$id_producto")){
$validar++;
}
}
}else{
$status='EN PROCESO';
}
$id_usuario=$_SESSION['id_usuario'];
if($validar>0) {
 echo "<br><div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede eliminar.</h5></div>
                      <p class='text-center'>Ha ocurrido un error al cancelar esta venta.</p>";
}else{

if(consultasSQL::UpdateSQL("venta", "status='CANCELADA'", "id_venta=$id_venta")){
if(consultasSQL::InsertSQL("cancelaciones", "status_cancelacion,id_venta,id_usuario","'$status',$id_venta,$id_usuario")){
 echo "<br><div class='alert alert-primary alert-dismissable'>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <div class='text-center'><h5>  <i class='fa-window-close-o'></i>La venta ha sido cancelada.</h5></div>
                    
                      </div>";

}

}else{
 echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>Ha ocurrido un error.</h5></div>
                       <p class='text-center'>Error al Cancelar, por favor intente de nuevo.</p>
                       </div>";
    	    }	
	
}
}else{
echo "<br><div class='alert alert-danger alert-dismissable'>
                       <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                       <div class='text-center'><h5>  <i class='fa-window-close-o'></i>No se puede cancelar.</h5></div>
                       <p class='text-center'>Esta venta ya se encuentra cancelada o en proceso de cancelación.</p>
                       </div>";	
}

?>