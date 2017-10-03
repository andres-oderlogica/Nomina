$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "clases/control_crud.php",
    type: "POST",
    dataType: "json",
    data: {id:$('#modal_id').val(),
    asunto:$('#asunto').val(),
    correo:$('#correo').val(),
    mpadre:$('#mail_padre').val(),
    malumno:$('#mail_alumno').val()
    },
          })
      .done(function(data) {   
           if(data == -1 || data == -2){
      alert("Se produjo un error, Verificar que el correo del docente exista o que no hay campos vacios.")
    }else{
      alert("Se envio el correo con exito")
          $('#asunto').val("")
          $('#correo').val("")
          $('#mail_padre').val("")
          $('#mail_alumno').val("")
          $('#myModal').modal('toggle');}
             })
      .always(function(){
       // $('#myModal').modal('toggle');
      //parent.verCargas(); 

      })
      
    });



})