$(document).ready(function($){

$('#cdosI').prop('disabled', true);
$('#cunoII').prop('disabled', true);
$('#cdosII').prop('disabled', true);
$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"1"},
          })
      .done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            $("#comboGrado").append('<option value = "'+data[i].id_grado+'">'+data[i].curso+'</option>');
         
        }   
            
    });

$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"2"},
          })
      .done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            $("#comboPeriodo").append('<option value = "'+data[i].id_periodo+'">'+data[i].descripcion+'</option>');
         
        }    
            
    });

      $('select#comboGrado').on('change click keyup input paste',function(){
     var idg = $(this).val(); 
     var corte= $( "input:radio[name=corte]:checked" ).val();                  
    $("#boton").html('<a href="generador_portada_por_grado.php?id_grado='+idg+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span></button></a>   <a href="generador_por_grado.php?id_grado='+idg+'&corte='+corte+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span></button></a>');
               
             });







});

 
