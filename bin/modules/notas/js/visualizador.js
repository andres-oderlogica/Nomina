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
$(document).ready(function(){

cod_estudiante=$("#cod_estudiante").val();
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

$('select#comboPeriodo').on('change click keyup input paste',function(){
      

      periodo = $(this).val();                   
               
               //verCargas()                   
                           verCargas2(periodo);
                            
             });
	
function verCargas2(periodo)
{
    $.ajax({
         url: '../boletines/visualizador_padres.php',
        type: "POST",
        dataType:'html',
        data:{periodo:periodo,cod_estudiante:cod_estudiante},
        success: function (datos)
        { 
            console.log(datos)
            if(datos != "1")
            {

            $('#ver_cargas2').html(datos);
           
            $('#myTable2').DataTable({
                sPaginationType: "bootstrap",
                 aLengthMenu: [100],
                language: {sProcessing: "Procesando...",
                responsive: true,
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
              else
              {
                alert("No se han registrado pagos");
              }


        }
    });
}



});