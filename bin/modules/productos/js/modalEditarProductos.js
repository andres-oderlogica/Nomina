$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "../controllers/control_productos.php",
    type: "POST",
    dataType: "json",
    data: {accion:"editar",
    id:$('#modal_id').val(),
    codigo:$('#modal_codigo').val(), 
    descripcion:$('#modal_descripcion').val(),
    precio:$('#modal_precio').val(),
    existencias:$('#modal_existencias').val(),
    iva:$('#modal_iva').val()},
          })
      .done(function() {               
             });
      $('#myModal').modal('toggle');
      parent.tabla("")   
    });



})