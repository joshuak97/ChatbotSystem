<?php
session_start();

?>
<iframe style="width: 100%;" height="500" src="tcpdf/pdf/ticket.php?codigo=<?php echo $_SESSION['id_venta_realizada'];?>"></iframe>