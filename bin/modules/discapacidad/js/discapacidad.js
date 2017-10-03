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
function verCargas()
{
    $.ajax({
        url: 'clases/control_listar.php',
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

/*function eliminar(id)
{
    bootbox.alert("Desea eliminar el dato?", function(){    
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
               verCargas()  
            }
        });

    })
}*/

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
               verCargas()  
            }
        });
}}

    })
}

 verCargas()
$(function ()
{

$('#form_discapacidad').submit(function (e)
    {
        e.preventDefault();        
        var data = new FormData($("#form_discapacidad")[0]);
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
                                 $('#descripcion').val("")
                                })
                
            },
            complete: function () {
               verCargas()  
            }
        });
    });
 });


function editar(id)
{	
	
	$.ajax({    url: "clases/control_crud.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"2",id:id},
          })
      .done(function(data) {
      console.log(data) 
    $("#modal_id").val(data.id_discapacidad);
    $("#modal_descripcion").val(data.descripcion);
	        
    });    

     
}



