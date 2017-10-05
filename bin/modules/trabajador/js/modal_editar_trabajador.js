$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "clases/control_crud.php",
    type: "POST",
    dataType: "json",
    data: {opcion:"3",
    id:$('#modal_id').val(),
    codigo:$('#modal_codigo').val(),
    documento:$('#modal_documento').val(),
    primer_apellido:$('#modal_primer_apellido').val(),
    segundo_apellido:$('#modal_segundo_apellido').val(),
    primer_nombre:$('#modal_primer_nombre').val(),
    segundo_nombre:$('#modal_segundo_nombre').val(),
    direccion:$('#modal_direccion').val(),
    telefono_fijo:$('#modal_telefonofijo').val(),
    email:$('#modal_email').val(),
    celular:$('#modal_celular').val(),
    barrio:$('#modal_barrio').val(),
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