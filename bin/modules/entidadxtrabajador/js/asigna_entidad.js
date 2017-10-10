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



function verCargas(id)
{
   $.ajax({
        url: 'clases/control_listar.php',
        type: "POST",
        dataType:'html',
        data:{opcion:1, grado:id},
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
               verCargas($("#grado").val())
              // verCargas2($("#grado").val())
            }
        });
}}

    })
}

 //verCargas()
$(function ()
{

$('#form_materiaxgrado').submit(function (e)
    {
        e.preventDefault();
        var data = new FormData($("#form_materiaxgrado")[0]);
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
                             //location.reload();
                                })

            },
            complete: function () {
              $('#btn_saveg').attr("disabled", true);
               verCargas($("#grado").val())
            }
        });
    });
 });




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

              });

 }}

    })
}
else
{
    bootbox.alert('Debe digitar datos del grado a matricular');
}

}

$('#search').typeahead({
    source: function (query) {
        var self = this;
        self.map = {};
        var items = [];

        var data = [
            {"id": 1, "label": "machin"},
            {"id": 2, "label": "truc"}
        ];

        $.each(data, function (i, item) {
            self.map[item.label] = item;
            items.push(item.label)
        });

        return items;
    },

    updater: function (item) {
        var selectedItem = this.map[item];
        this.$element.data('selected', selectedItem);
        return item;
    }
});

$(document).ready(function($){
$('#btn_saveg').attr("disabled", true);

$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"1"},
          })
      .done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            $("#comboGrado").append('<option value = "'+data[i].id_trabajador+'">'+data[i].nombres+'</option>');

        }

    });

  /*  $('#search').typeahead({
      source: function (query, process) {
      states = [];
      map = {};

      var data = [
          {"stateCode": "CA", "stateName": "California"},
          {"stateCode": "AZ", "stateName": "Arizona"},
          {"stateCode": "NY", "stateName": "New York"},
          {"stateCode": "NV", "stateName": "Nevada"},
          {"stateCode": "OH", "stateName": "Ohio"}
      ];

      $.each(data, function (i, state) {
          map[state.stateName] = state;
          states.push(state.stateName);
      });

      process(states);
  },
    updater: function (item) {
      selectedState = map[item].stateCode;
 return item;
    },
    matcher: function (item) {
      if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
        return true;
    }
    },
    sorter: function (items) {
        return items.sort();
    },
    highlighter: function (item) {
      var regex = new RegExp( '(' + this.query + ')', 'gi' );
   return item.replace( regex, "<strong>$1</strong>" );
    },
});*/

/*$.ajax({  url: "combo/control_combox.php",
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

        }

    });


$('select#comboJornada').on('change click keyup input paste',function(){
     var id = $(this).val();

                    $("#jornada").val(id);

             });*/

$('select#comboGrado').on('change click keyup input paste',function(){
     var idg = $(this).val();
     $('#btn_saveg').attr("disabled", false);
               $("#grado").val(idg);
               verCargas(idg)
              // verCargas()

             });

/*$('select#comboDocente').on('change click keyup input paste',function(){
     var idd = $(this).val();

                    $("#docente").val(idd);

             });*/



});
