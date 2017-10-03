$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "clases/control_crud.php",
    type: "POST",
    dataType: "json",
    data: {opcion:"3",
    id:$('#modal_id').val(),
    letra:$('#modal_letra').val(),
    numero:$('#modal_numero').val(),
    desc:$('#modal_descripcion').val() 
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