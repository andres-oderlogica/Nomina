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
}*/
function verCargas()
{
  $("#loader").fadeIn('slow');
    $.ajax({
        url: 'clases/control_listar.php',
        beforeSend: function(objeto){
         $('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function (data)
        {
            $('#ver_cargas').html(data);
           
            $('#myTable').DataTable({
                sPaginationType: "bootstrap", 
                //aLengthMenu: [100],
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
           $('#loader').html('');
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
            }
        });
}}

    })
}

 verCargas()
$(function ()
{

$('#form_estudiante').submit(function (e)
    {
        e.preventDefault();        
        var data = new FormData($("#form_estudiante")[0]);
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
                    bootbox.alert('Se presento un error al registrar el dato');
                }
                    bootbox.alert("Se Guardo con exito", function(){ 
                                
                                })
                
            },
            complete: function () {
               verCargas()  
                $('#codigo').val("")  
                $('#identificacion').val("")                     
                $('#primer_nombre').val("")
                $('#primer_apellido').val("")
                $('#segundo_nombre').val("")
                $('#segundo_apellido').val("")
                $('#direccion').val("")
                $('#telefono').val("")
                $('#email').val("")
                $('#discapacidad').val("")
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
      //console.log(data) 
    $("#modal_id").val(data.id_estudiante);
    $("#modal_codigo").val(data.codigo);
    $("#modal_identificacion").val(data.identificacion);
    $("#modal_primer_apellido").val(data.primer_apellido);
    $("#modal_segundo_apellido").val(data.segundo_apellido);
    $("#modal_primer_nombre").val(data.primer_nombre);
    $("#modal_segundo_nombre").val(data.segundo_nombre);
    $("#modal_direccion").val(data.direccion);
    $("#modal_telefono").val(data.telefono);
    $("#modal_email").val(data.email);
    $("#modal_discapacidad").val(data.discapacidad);
    $("#modal_fecha_nacimiento").val(data.fecha_nacimiento);
    $("#modal_usuario").val(data.usuario);
	        
    });    

     
}



