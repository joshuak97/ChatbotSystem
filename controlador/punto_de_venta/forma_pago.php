<?php
session_start();

if($_POST['forma_pago']!=1){
?>
<label>Importe:</label>
<input class="form-control" type="number" step="0.01"  value="<?php echo $_SESSION['sumaTotal'];?>" readonly="">
<input type="hidden" id="importe" value="<?php echo $_SESSION['sumaTotal'];?>">
<?php
}else{
 ?>
  <label>Importe:</label>
              <input class="form-control" type="number" step="0.01" id="importe" placeholder="$0.00" min="0.00">
 <?php 
}

?>