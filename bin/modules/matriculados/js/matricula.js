function pag_data_table()
{
    var menu = $('#myTable_paginate').html();
    menu = ('<nav aria-label="..."><ul class="pagination" id="pag_ul">' + menu + '</ul></nav>');
    menu = menu.replace('<span>', '');
    menu = menu.replace('</span>', '');
    $('#myTable_paginate').html(menu);
    var li = $('#pag_ul').html();
    li = li.replace(/<a/g, '<li><a');
    var buscar = '</a>';
    li = li.replace(new RegExp(buscar, "g"), '</li></a>');
    $('#pag_ul').html(li);
    $('.dataTables_filter label input[type="search"]').addClass('form form-control');
    $('input[name="myTable_length"]').addClass('form form-control');
}

function pag_data_table2()
{
    var menu = $('#myTable2_paginate').html();
    menu = ('<nav aria-label="..."><ul class="pagination" id="pag_ul">' + menu + '</ul></nav>');
    menu = menu.replace('<span>', '');
    menu = menu.replace('</span>', '');
    $('#myTable2_paginate').html(menu);
    var li = $('#pag_ul').html();
    li = li.replace(/<a/g, '<li><a');
    var buscar = '</a>';
    li = li.replace(new RegExp(buscar, "g"), '</li></a>');
    $('#pag_ul').html(li);
    $('.dataTables_filter label input[type="search"]').addClass('form form-control');
    $('input[name="myTable2_length"]').addClass('form form-control');
}
function verCargas()
{
    $.ajax({
        url: 'clases/control_listar.php',
        type: "POST",
        dataType:'html',
        data:{opcion:1},
        success: function (data)
        {
            $('#ver_cargas').html(data);
           
            $('#myTable').DataTable({
                language: {sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                }});
            $('.dataTables_filter label').css('display', 'block !important');
            pag_data_table();
        }
    });
}


function verCargas2(idgrado)
{
    $.ajax({
         url: 'clases/control_listar.php',
        type: "POST",
        dataType:'html',
        data:{opcion:2, grado:idgrado},
        success: function (data)
        {
            $('#ver_cargas2').html(data);
           
            $('#myTable2').DataTable({
                language: {sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sInfoPostFix: "",
                    sSearch: "Buscar:",
                    sUrl: "",
                    sInfoThousands: ",",
                    sLoadingRecords: "Cargando...",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                }});
            $('.dataTables_filter label').css('display', 'block !important');
            pag_data_table2();
        }
    });
}


function eliminar(id)
{
bootbox.confirm({
    message: "Desea eliminar el dato ?",
    buttons: {
        confirm: {
            label: 'Si',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
    if(result){
    $.ajax({
        url: 'clases/control_crud.php',
        type: "POST",
        dataType:'json',
        data:{opcion:1, id:id},
        success: function (data)
        {
             if (!data.eliminado)
                {
                    bootbox.alert('Error al eliminar el dato');
                }
                else
                {
                    //bootbox.alert("Se elimino con exito");                        
                                
                }

        },
         complete: function () {
               //verCargas() 
               verCargas2($("#grado").val())  
            }
        });
}}

    })
}

 //verCargas() 
$(function ()
{

/*$('#form_docente').submit(function (e)
    {
        e.preventDefault();        
        var data = new FormData($("#form_docente")[0]);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (!data.guardado)
                {
                    bootbox.alert('Se presento un error al regisrar el dato');
                }
                    bootbox.alert("Se Guardo con exito", function(){ 
                                 $('#identificacion').val("")                     
                                 $('#nombre_completo').val("")
                                 $('#direccion').val("")
                                 $('#telefono').val("")
                                 $('#correo').val("")
                                })
                
            },
            complete: function () {
               verCargas()  
            }
        });
    });*/
 });

function editarMatricula(id)
{
    bootbox.confirm({                   
                     
    message: "Desea matricular el alumno en el grado ?",
    buttons: {
        confirm: {
            label: 'Si',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
    if(result){
    
    $.ajax({  url: "clases/control_crud.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"3",estudiante:id
                    },
          })
      .done(function(data){
         })
          .fail(function(){             
            })
             .always(function(){
             verCargas() 
             verCargas2($("#grado").val())                
              }); 

 }}

    })

}

function crearPlantillaNotas(id)
{
    

}


function editar(id)
{	
if($("#grado").val() != "" && $("#jornada").val() != "" && $("#docente").val() != "")
{
bootbox.confirm({                    
                     
    message: "Desea matricular el alumno en el grado ?",
    buttons: {
        confirm: {
            label: 'Si',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
    if(result){
	
	$.ajax({  url: "clases/control_crud.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"4",
                     id_estudiante:id,
                     id_grado:$("#grado").val(),
                     id_jornada:$("#jornada").val(),
                     id_docente:$("#docente").val(),
                     desde:$("#desde").val(),
                     hasta:$("#hasta").val(),
                     estado:"1"},
          })
      .done(function(data){
         })
          .fail(function(){             
            })
             .always(function(){
             verCargas() 
             verCargas2($("#grado").val())                
              }); 

 }}

    })
}
else
{
    bootbox.alert('Debe digitar datos del grado a matricular');
}
     
}

$(document).ready(function($){
$('#ocultar').prop('disabled', true);
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
            $("#comboJornada").append('<option value = "'+data[i].id_jornada+'">'+data[i].descripcion+'</option>');
         
        }    
            
    });

$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"3"},
          })
      .done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            $("#comboDocente").append('<option value = "'+data[i].id_docente+'">'+data[i].nombre_completo+'</option>');
            $("#comboDocente").change(0);
        }    
            
    });


$('select#comboJornada').on('change click keyup input paste',function(){
     var id = $(this).val();                      
                    
                    $("#jornada").val(id);                   
                           
             });

$('select#comboGrado').on('change click keyup input paste',function(){
     var idg = $(this).val();                   
               $("#grado").val(idg); 
               verCargas2(idg)
               //verCargas()                   
                           
             });


$('select#comboDocente').on('change click keyup input paste',function(){
     var idd = $(this).val();                      
                    
                    $("#docente").val(idd);                   
                           
             });

$("#ocultar").click(function(){
    //alert("prueba")
    $("#docente").val("");
    $("#grado").val("");
    $("#grado").val("");
    $("#desde").val("");
    $("#hasta").val("");
   location.reload();

})

});

 
