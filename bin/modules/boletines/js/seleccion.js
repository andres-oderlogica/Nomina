$(document).ready(function($){

/*$('#cdosI').prop('disabled', true);
$('#cunoII').prop('disabled', true);
$('#cdosII').prop('disabled', true);*/

/*$('#sII').prop('disabled', true);
$('#final').prop('disabled', true);*/
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
     var semestre= $( "input:radio[name=semestre]:checked" ).val();  
    $("#boton").html('<a href="generador_promedios_por_grado.php?id_grado='+idg+'&corte='+corte+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span>Generar Reporte</button></a><a href="excel_por_corte.php?id_grado='+idg+'&corte='+corte+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span>Generar Reporte en Excel</button></a>');
    $("#boton2").html('<a href="generador_promedios_por_semestre_por_grado.php?id_grado='+idg+'&semestre='+semestre+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span>Generar Reporte</button></a><a href="excel_por_semestre.php?id_grado='+idg+'&semestre='+semestre+'" target="_blank"><button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal"><span class="glyphicon glyphicon-minus-sign"></span>Generar Reporte en Excel</button></a>');
               
             });







});

 
