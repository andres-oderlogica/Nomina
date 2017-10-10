$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "clases/control_crud.php",
    type: "POST",
    dataType: "json",
    data: {opcion:"3",
    id:$('#modal_id').val(),
    identificacion:$('#modal_identificacion').val(),
    nombre_completo:$('#modal_nombre_completo').val(),
    direccion:$('#modal_direccion').val(),
    telefono:$('#modal_telefono').val(),
    correo:$('#modal_correo').val() 
    },
          })
      .done(function() {               
             })
      .always(function(){
        $('#myModal').modal('toggle');
      parent.verCargas(); 

      })
      
    });



})