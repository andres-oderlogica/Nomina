/* Modificación de la clase predeterminada */
$.extend( $.fn.dataTableExt.oStdClasses, {
 "sSortAsc": "header headerSortDown",
 "sSortDesc": "header headerSortUp",
 "sSortable": "header"
} );

/* Método de la API para obtener información de paginación */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
 return {
  "iStart":         oSettings._iDisplayStart,
  "iEnd":           oSettings.fnDisplayEnd(),
  "iLength":        oSettings._iDisplayLength,
  "iTotal":         oSettings.fnRecordsTotal(),
  "iFilteredTotal": oSettings.fnRecordsDisplay(),
  "iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
  "iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
 };
}

/* Control de la paginación del estilo Bootstrap */
$.extend( $.fn.dataTableExt.oPagination, {
 "bootstrap": {
  "fnInit": function( oSettings, nPaging, fnDraw ) {
   var oLang = oSettings.oLanguage.oPaginate;
   var fnClickHandler = function ( e ) {
    e.preventDefault();
    if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
     fnDraw( oSettings );
    }
   };

   $(nPaging).addClass('pagination').append(
  //  menu = ('<nav aria-label="..."><ul class="pagination" id="pag_ul">' + menu + '</ul></nav>');
 /*   '<ul>'+
    '<li><a href="#">&laquo;'+oLang.sPrevious+'</a></li>'+
    '<li><a href="#">'+oLang.sNext+'&raquo;</a></li>'+
    '</ul>'*/
    '<nav aria-label="..."><ul class="pagination" id="pag_ul">' +
    '<li><a href="#">&laquo;'+oLang.sPrevious+'</a></li>'+
    '<li><a href="#">'+oLang.sNext+'&raquo;</a></li>'+
    '</ul>'+ '</ul></nav>'
   );

   var els = $('a', nPaging);
   $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
   $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
  },

  "fnUpdate": function ( oSettings, fnDraw ) {
   var iListLength = 5;
   var oPaging = oSettings.oInstance.fnPagingInfo();
   var an = oSettings.aanFeatures.p;
   var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

   if ( oPaging.iTotalPages < iListLength) {
    iStart = 1;
    iEnd = oPaging.iTotalPages;
   }
   else if ( oPaging.iPage <= iHalf ) {
    iStart = 1;
    iEnd = iListLength;
   } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
    iStart = oPaging.iTotalPages - iListLength + 1;
    iEnd = oPaging.iTotalPages;
   } else {
    iStart = oPaging.iPage - iHalf + 1;
    iEnd = iStart + iListLength - 1;
   }

   for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
    // Remover los elementos intermedios
    $('li:gt(0)', an[i]).filter(':not(:last)').remove();

    // Añadir los nuevos elementos de la lista y sus controladores de eventos
    for ( j=iStart ; j<=iEnd ; j++ ) {
     sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
     $('<li '+sClass+'><a href="#">'+j+'</a></li>')
     .insertBefore( $('li:last', an[i])[0] )
     .bind('click', function (e) {
      e.preventDefault();
      oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
      fnDraw( oSettings );
     });
    }

    // agregar/quitar clases desabilitadas a partir de los elementos estáticos
    if ( oPaging.iPage === 0 ) {
     $('li:first', an[i]).addClass('disabled');
    } else {
     $('li:first', an[i]).removeClass('disabled');
    }

    if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
     $('li:last', an[i]).addClass('disabled');
    } else {
     $('li:last', an[i]).removeClass('disabled');
    }
   }
  }
 }
});



/*function pag_data_table()
{
    var menu = $('#myTable_paginate').html();
   // menu = ('<nav aria-label="..."><ul class="pagination" id="pag_ul">' + menu + '</ul></nav>');
   menu = ( '<ul>'+
    '<li><a href="#">&laquo;'+oLang.sPrevious+'</a></li>'+
    '<li><a href="#">'+oLang.sNext+'&raquo;</a></li>'+
    '</ul>');
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
}*/

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
             sPaginationType: "bootstrap", 
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
    $('.dataTables_filter label input[type="search"]').addClass('form form-control');
    $('input[name="myTable_length"]').addClass('form form-control');
        }
    });
}

function verCargas2()
{
    $.ajax({
         url: 'clases/control_listar.php',
        type: "POST",
        dataType:'html',
        data:{opcion:2, idm:$("#docente").val()},
        success: function (data)
        {
            $('#ver_cargas2').html(data);
           
            $('#myTable2').DataTable({
               sPaginationType: "bootstrap", 
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
             $('.dataTables_filter label input[type="search"]').addClass('form form-control');
            $('input[name="myTable_length"]').addClass('form form-control');
            
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
               verCargas() 
               verCargas2()  
            }
        });
}}

    })
}

function inactivar(id)
{
bootbox.confirm({
    message: "Desea inactivar el docente de la materia ?",
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
        data:{opcion:6, id:id},
        success: function (data)
        {
             if (!data.editado)
                {
                    bootbox.alert('Error al editar el dato');
                }
                else
                {
                    //bootbox.alert("Se elimino con exito");                        
                                
                }

        },
         complete: function () {
               verCargas() 
               verCargas2()  
            }
        });
}}

    })
}

function activar(id)
{
bootbox.confirm({
    message: "Desea activar el docente de la materia ?",
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
        data:{opcion:7, id:id},
        success: function (data)
        {
             if (!data.editado)
                {
                    bootbox.alert('Error al editar el dato');
                }
                else
                {
                    //bootbox.alert("Se elimino con exito");                        
                                
                }

        },
         complete: function () {
               verCargas() 
               verCargas2()  
            }
        });
}}

    })
}


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
             verCargas2()                
              }); 

 }}

    })

}

function reemplazar(id)
{
    bootbox.confirm({                   
                     
    message: "Desea asignar nuevo docente a la materia ?",
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
              data: {opcion:"8",docente:id, mxg:$("#docente").val(), anio:$("#anio").val()
                    },
          })
      .done(function(data){
        if (!data.editado)
                {
                    bootbox.alert('Se presento un error al registrar el dato');
                }
                else{
                  bootbox.alert('Se realizo el cambio con exito');
                }
         })
          .fail(function(){             
            })
             .always(function(){
             verCargas() 
             verCargas2()                
              }); 

 }}

    })

}


function editar(id)
{	
if($("#docente").val() != "")
{
bootbox.confirm({                    
                     
    message: "Desea Asignar el docente al grado ?",
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
                     docente:id,
                     mxg:$("#docente").val(),
                     anio:$("#anio").val()},
          })
      .done(function(data){
         //if (!data.guardado)
             //   {
                    bootbox.alert(data);
              //  }
         })
          .fail(function(){             
            })
             .always(function(){
             verCargas() 
             verCargas2()                
              }); 

 }}

    })
}
else
{
    bootbox.alert('Debe elegir datos');
}
     
}

$(document).ready(function($){
verCargas()
$("#combodocente").select2();
$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"3"},
          })
      .done(function(data) {
       // console.log(data)
        for (var i = 0; i < data.length; i++)
        {
            $("#combodocente").append('<option value = "'+data[i].id_mxg+'">'+data[i].curso+'</option>');
         
        }    
            
    });

$('select#combodocente').on('change click keyup input paste',function(){
     var idd = $(this).val();                     
      $("#docente").val(idd);
      verCargas2();                   
                           
             });

$('#anios').on('change click keyup input paste',function(){
     var ix = $(this).val();                     
      $("#anio").val(ix);
      //verCargas2();                   
                           
             });

/*$('#form_matricula').submit(function (e)
    {
        e.preventDefault();        
        var data = new FormData($("#form_matricula")[0]);
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
 



//})

});

 
