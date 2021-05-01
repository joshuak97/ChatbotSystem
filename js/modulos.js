//Esta funcion reemplaza el contenido de la pagina mostrando las vistas que seleccionemos en la interfaz
function cargarVistas(modulo){
 window.location.href="home.php?modulo="+modulo;
}

 

//Eventos de los formularios del sistema

/***************************************************************************************************/
/*         SUCURSALES                                                                              */
/***************************************************************************************************/



/***************************************************************************************************/
/*         PROVEEDORES                                                                             */
/***************************************************************************************************/


/******************************MODAL AGREGAR PROVEEDORES********************************************/
$(document).ready(function() {
	//Metodo que permite agregar un proveedor desde modal:
    $('#modal_agregar_categoria form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_agregar_categoria form').serialize();
         var metodo=$('#modal_agregar_categoria form').attr('method');
         var peticion=$('#modal_agregar_categoria form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-agregar-categoria").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-agregar-categoria").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-agregar-categoria").html(data);
            }
        });
        return false;
    });

    //Evento que recarga la pagina cada vez que se cierra el modal agregar proveedor:
    $("#modal_agregar_categoria").on("hidden.bs.modal",function() {
    $.post("controlador/categorias/tabla_categorias.php", function(data){
     $("#tabla_categorias").html(data);
     });
    });

   
	//Evento que limpia el formulario del modal agregar proveedor al desplegarse
    
    $("#modal_agregar_categoria").on("show.bs.modal",function() {
    document.getElementById('form_agregar_categoria').reset();
    $("#res-form-agregar-categoria").html('');
    });

    });

	/********************************MODAL EDITAR PROVEEDORES*****************************************************/

    //Metodo que llena el modal editar con los datos del proveedor
    function editar_categoria(id_categoria,nombre_categoria){
    $('#id_categoria').val(id_categoria);
    $('#nombre_categoria').val(nombre_categoria);
    
    $("#modal_editar_categoria").modal('show');
    }

    //Evento que permite editar en el modal editar proveedores

    $(document).ready(function() {
	//Metodo que permite editar un proveedor desde modal:
    $('#modal_editar_categoria form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_editar_categoria form').serialize();
         var metodo=$('#modal_editar_categoria form').attr('method');
         var peticion=$('#modal_editar_categoria form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-editar-categoria").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-editar-categoria").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-editar-categoria").html(data);
            }
        });
        return false;
    });

    //Evento que recarga la pagina cada vez que se cierra el modal editar proveedor:
    $("#modal_editar_categoria").on("hidden.bs.modal",function() {
    $.post("controlador/categorias/tabla_categorias.php", function(data){
     $("#tabla_categorias").html(data);
     });
    });

   
	//Evento que limpia el formulario del modal editar proveedor al desplegarse
    
    $("#modal_editar_categoria").on("show.bs.modal",function() {
    $("#res-form-editar-categoria").html('');
    });

    });
    /*******************************MODAL ELIMINAR PROVEEDOR***************************************/
    //Metodo que llena el modal eliminar con los datos del proveedor
    function eliminar_categoria(id_categoria){
    $('#id_categoria_e').val(id_categoria);
    $("#modal_eliminar_categoria").modal('show');
    }
    
 
    //Evento que permite eliminar en el modal eliminar categorias

    

    $(document).ready(function() {
    //Evento que recarga la pagina cada vez que se cierra el modal eliminar proveedor:
    $("#modal_eliminar_categoria").on("hidden.bs.modal",function() {
    $.post("controlador/proveedores/tabla_categorias.php", function(data){
     $("#tabla_categorias").html(data);
     });
    });
    });

/***************************************************************************************************/
/*         PRODUCTOS                                                                               */
/***************************************************************************************************/

/******************************MODAL AGREGAR PRODUCTO********************************************/
/*$(document).ready(function() {
    //Metodo que permite agregar un proveedor desde modal:
    $('#modal_agregar_producto form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_agregar_producto form').serialize();
         var metodo=$('#modal_agregar_producto form').attr('method');
         var peticion=$('#modal_agregar_producto form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-agregar-producto").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-agregar-producto").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-agregar-producto").html(data);
            }
        });
        return false;
    });*/

    //Evento que recarga la pagina cada vez que se cierra el modal agregar proveedor:
    $("#modal_agregar_producto").on("hidden.bs.modal",function() {
    $.post("controlador/productos/tabla_productos.php", function(data){
     $("#tabla_productos").html(data);
     });
    });

   
    //Evento que limpia el formulario del modal agregar proveedor al desplegarse
    
    $("#modal_agregar_producto").on("show.bs.modal",function() {
    document.getElementById('form_agregar_producto').reset();
    $("#res-form-agregar-producto").html('');
    });

   

    /********************************MODAL EDITAR PRODUCTO*****************************************************/

    //Metodo que llena el modal editar con los datos del proveedor
    function editar_producto(id_producto){
    $('#id_producto').val(id_producto); 
    //Con este post llenamos el modal editar con los datos del producto con exepcion de los select
    $.post("controlador/productos/cargar_datos_editar_producto.php",{id_producto:id_producto}, function(data){
    $("#campos-editar-producto").html(data);
    });
    $("#modal_editar_producto").modal('show');
    }


    //Evento que permite editar en el modal editar productos

    $(document).ready(function() {
    //Metodo que permite editar un proveedor desde modal:
   /* $('#modal_editar_producto form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_editar_producto form').serialize();
         var metodo=$('#modal_editar_producto form').attr('method');
         var peticion=$('#modal_editar_producto form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-editar-producto").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-editar-producto").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-editar-producto").html(data);
            }
        });
        return false;
    });*/

    //Evento que recarga la pagina cada vez que se cierra el modal editar proveedor:
    $("#modal_editar_producto").on("hidden.bs.modal",function() {
    $.post("controlador/productos/tabla_productos.php", function(data){
     $("#tabla_productos").html(data);
     });
    });

   
    //Evento que limpia el formulario del modal editar proveedor al desplegarse
    
    $("#modal_editar_producto").on("show.bs.modal",function() {
    $("#res-form-editar-producto").html('');
    });

    });
    /*******************************MODAL ELIMINAR PRODUCTO***************************************/
    //Metodo que llena el modal eliminar con los datos del proveedor
    function eliminar_producto(id_producto){
    $('#id_producto_e').val(id_producto);
    $("#modal_eliminar_producto").modal('show');
    }
    
 
    //Evento que permite eliminar en el modal eliminar productos

    

    $(document).ready(function() {
    //Evento que recarga la pagina cada vez que se cierra el modal eliminar proveedor:
    $("#modal_eliminar_categoria").on("hidden.bs.modal",function() {
    $.post("controlador/producto/tabla_productos.php", function(data){
     $("#tabla_productos").html(data);
     });
    });
    });

 //Evento que permite consultar productos en el modal agregar entradas:
 
 function consultar_productos_entrada(componente){
var valor=componente.value;
$.post("controlador/productos/consultar_productos.php", { valor:valor }, function(data){
 $("#tabla_productos_entrada").html(data);
 });
 }   

 //Funcion que permite seleccionar un producto del modal agregar entrada
function seleccionar_producto_entrada(id_producto){
cantidad=1;
$.post("controlador/productos/carrito.php", { id_producto: id_producto, cantidad:cantidad }, function(data){
 $("#tabla_entradas").html(data);
 });     
}

function modificar_precio_costo(componente,posicion){
var precio_costo=componente.value;
$.post("controlador/productos/modificar_precio_costo.php", { precio_costo: precio_costo, posicion: posicion }, function(data){
$("#res-entradas").html(data);
});
}

function eliminar_elemento_entrada(id_producto,posicion){
$.post("controlador/productos/delCarrito.php", { id_producto: id_producto, posicion: posicion }, function(data){
  $("#tabla_entradas").html(data);
  });
}


//Permite agregar un producto al presionar enter sobre el campo de texto principal
$('#txtcodigo_entradas').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var codigo=document.getElementById('txtcodigo_entradas').value;
    var cantidad=1;
    if(keycode == '13'){
        if(codigo!=""){
        $.post("controlador/productos/carrito2.php", { codigo: codigo, cantidad:cantidad }, function(data){
        $("#tabla_entradas").html(data);
        });
        }else{
        alert("Ingrese un codigo valido");    
        }
    }
});


/********************************AGREGAR ENTRADA DE PRODUCTO****************************************/
    
 /*  $(document).ready(function() {
    //Metodo que permite agregar un proveedor desde modal:
    $('#modal_agregar_entradas form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_agregar_producto form').serialize();
         var metodo=$('#modal_agregar_producto form').attr('method');
         var peticion=$('#modal_agregar_producto form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-agregar-producto").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-agregar-producto").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-agregar-producto").html(data);
            }
        });
        return false;
    });

    }); */

    //Metodo que llena el modal eliminar con los datos del proveedor
    function eliminar_entrada(id_entrada){
    $('#id_entrada').val(id_entrada);
    $("#modal_eliminar_entrada").modal('show');
    }

/***************************************************************************************************/
/*         PUNTO DE VENTA                                                                          */
/***************************************************************************************************/

//Permite agregar un producto al presionar enter sobre el campo de texto principal
$('#txtcodigo').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var codigo=document.getElementById('txtcodigo').value;
    var cantidad=1;
    if(keycode == '13'){
        if(codigo!=""){
        $.post("controlador/punto_de_venta/carrito2.php", { codigo: codigo, cantidad:cantidad }, function(data){
        $("#tabla_carrito").html(data);
        });
        }else{
        alert("Ingrese un codigo valido");    
        }
    }
});
//Permite añadir productos al carrito tabla-consultar-productos
function addCarrito(id_producto){
  var cantidad=1;
  if(id_producto!=0 && cantidad!=""){
 $.post("controlador/punto_de_venta/carrito.php", { id_producto: id_producto, cantidad:cantidad }, function(data){
 $("#tabla_carrito").html(data);
 });  
  }else{
  alert("Por favor complete todos los datos del producto");  
  }
  }

//Permite eliminar productos del carrito tablaProducto
  function eliminarElemento(id_producto,posicion){
  $.post("controlador/punto_de_venta/delCarrito.php", { id_producto: id_producto, posicion: posicion }, function(data){
  $("#tabla_carrito").html(data);
  });
  }

//Permite eliminar productos del carrito tablaProducto
  function editarElemento(id_producto){
  $('#id_producto').val(id_producto);
  $.post("controlador/punto_de_venta/input_precio_venta.php",{id_producto:id_producto}, function(data){
  $("#precio_venta_con").html(data);      
    });
  $('#modal_editar_precio').modal('show');
  }

//permite modificar la cantidad del carrito
function modificarCantidadCarrito(posicion,componente){
var cantidad=componente.value;
$.post("controlador/punto_de_venta/modificarCantidadCarrito.php", { cantidad: cantidad, posicion: posicion }, function(data){
$("#mostrar-subtotal").html(data);
});
}

//FUNCION QUE REALIZA LA CONSULTA EN EL MODAL DE CONSULTAR PRODUCTOS.
function consultar_productos(componente){
valor=componente.value;
 $.post("controlador/punto_de_venta/consultar_productos.php", { valor:valor }, function(data){
 $("#tabla-consultar-producto").html(data);
 });  
}

//Funcion que permite seleccionar un producto del modal consultar productos
function seleccionar_producto(id_producto){
addCarrito(id_producto);
$('#modal-consultar-productos').modal('hide');      
}
//Permite agregar un producto al presionar enter sobre el campo de texto principal
$('#txtcodigo').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var codigo=document.getElementById('txtcodigo').value;
    var cantidad=1;
    if(keycode == '13'){
        if(codigo!=""){
        $.post("controlador/punto_de_venta/carrito2.php", { codigo: codigo, cantidad:cantidad }, function(data){
        $("#tabla_carrito").html(data);
        });
        }else{
        alert("Ingrese un codigo valido");    
        }
    }
});
//Funcion que cierra la venta
function vender(){
var id_pago=document.getElementById('id_pago').value;
var importe=document.getElementById('importe').value;

if(importe!=""){
$.post("controlador/punto_de_venta/realizar_venta.php",{id_pago:id_pago, importe:importe}, function(data){
$("#res-venta").html(data);
});
}else{
alert("Debe ingresar el importe");    
}
}

//

function guardar_precio(){
var id_producto=document.getElementById('id_producto').value;
var precio_venta=document.getElementById('precio_venta').value;
$.post("controlador/punto_de_venta/editar_precio_venta.php",{ id_producto:id_producto, precio_venta:precio_venta }, function(data){
$("#res_editar_precio").html(data);
});

}

function forma_pago(componente){
var forma_pago=componente.value;
$.post("controlador/punto_de_venta/forma_pago.php",{ forma_pago:forma_pago}, function(data){
$("#forma_pago").html(data);
});

}

$("#modal_venta_realizada").on("show.bs.modal",function() {
    $.post("controlador/punto_de_venta/mostrar_ticket.php", function(data){
$("#mostrar_ticket").html(data);
});

    });

function recargar_carrito(){
  $.post("controlador/punto_de_venta/recargar_carrito.php", function(data){
$("#tabla_carrito").html(data);      
    });
CierraPopup();
}

function CierraPopup() {
  $("#modal_editar_precio").modal('hide');//ocultamos el modal
  $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
  $('.modal-backdrop').remove();//eliminamos el backdrop del modal
}

 $("#modal_venta_realizada").on("hidden.bs.modal",function() {
    window.location.reload();
     });


 //Evento que recarga la pagina cada vez que se cierra el modal agregar proveedor:
    $("#modal_cancelar_venta").on("hidden.bs.modal",function() {
    $('#txt_cancelar_venta').val('');
    $("#res_cancelar_venta").html('');
    });

//Metodo que permite agregar un proveedor desde modal:
    $('#modal_agregar_categoria2 form').submit(function(e) {
         e.preventDefault();
         var informacion=$('#modal_agregar_categoria2 form').serialize();
         var metodo=$('#modal_agregar_categoria2 form').attr('method');
         var peticion=$('#modal_agregar_categoria2 form').attr('action');
         $.ajax({
            type: metodo,
            url: peticion,
            data:informacion,
            beforeSend: function(){
                $("#res-form-agregar-categoria").html('Agregando proveedor <br><img src="img/enviando.gif" class="center-all-contens">');
            },
            error: function() {
                $("#res-form-agregar-categoria").html("Ha ocurrido un error en el sistema");
            },
            success: function (data) {
                $("#res-form-agregar-categoria").html(data);
                $.post("controlador/entrada_productos/select-proveedores.php", function(data){
                $("#select-proveedores").html(data);      
                });
              
            }
        });
        return false;
    });



    //Evento que limpia el formulario del modal agregar proveedor al desplegarse
    
    $("#modal_agregar_categoria2").on("show.bs.modal",function() {
    document.getElementById('form_agregar_categoria2').reset();
    $("#res-form-agregar-categoria").html('');
    });



/***************************************************************************************************/
/*         VENTAS REALIZADAS                                                                       */
/***************************************************************************************************/


  function detalles_venta(id_venta,folio_venta){
  $.post("controlador/ventas_realizadas/detalles_venta.php",{id_venta:id_venta, folio_venta:folio_venta }, function(data){
  $("#detalles_venta").html(data);      
    });  
  $("#modal_detalles_venta").modal('show');
  }

  function cancelar_venta(id_venta){
  $('#id_venta').val(id_venta);  
  $("#modal_cancelar_venta").modal('show');
  }



/***************************************************************************************************/
/*         VENTAS REALIZADAS                                                                       */
/***************************************************************************************************/


  function rechazar_cancelacion(id_cancelacion){
  $('#id_cancelacion').val(id_cancelacion);  
  $("#modal_rechazar_cancelacion").modal('show');
  }


  function aprobar_cancelacion(id_cancelacion){
  $('#id_cancelacion2').val(id_cancelacion);  
  $("#modal_aprobar_cancelacion").modal('show');
  }
