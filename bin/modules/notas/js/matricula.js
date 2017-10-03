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
    });
}


function verCargas2(plantilla,periodo)
{
    $.ajax({
         url: 'clases/control_listar.php',
        type: "POST",
        dataType:'json',
        data:{opcion:2, plantilla:plantilla,periodo:periodo},
        success: function (datos)
        { 
            ids=datos[0];

            $('#ver_cargas2').html(datos[1]);
           
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
               verCargas2(plantilla,periodo)  
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

function actualizar(id)
{
bootbox.confirm({
    message: "Desea actualizar las notas ?",
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

      var n1=$("#n1"+id).val();
      var n2=$("#n2"+id).val();
      var n3=$("#n3"+id).val();
      var n4=$("#n4"+id).val();
      var n5=$("#n5"+id).val();
      var n6=$("#n6"+id).val();
      var n7=$("#n7"+id).val();
      var n8=$("#n8"+id).val();
      var n9=$("#n9"+id).val();
      

    $.ajax({
        url: 'clases/control_crud.php',
        type: "POST",
        dataType:'json',
        data:{opcion:5, id:id,n1:n1,n2:n2,n3:n3,n4:n4,n5:n5,n6:n6,n7:n7,n8:n8,n9:n9}}).done(function(data){
         })
          .fail(function(){             
            })
             .always(function(){
             //alert(periodo);
            verCargas2(plantilla,periodo);  
              });
}}

    })
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
plantilla=$('#plantilla').val();


$.ajax({  url: "combo/control_combox.php",
              type: "POST",
              dataType: "json",
              data: {opcion:"1"},
          })
      .done(function(data) {
        for (var i = 0; i < data.length; i++)
        {
            $("#comboPeriodo").append('<option value = "'+data[i].id_periodo+'">'+data[i].descripcion+'</option>');
         
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

$('select#comboPeriodo').on('change click keyup input paste',function(){
      periodo = $(this).val();                   
               
               //verCargas()                   
                           verCargas2(plantilla,periodo);
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

$("#all").click(function(){
   
 notasXid = new Array();
   for (var i = 0; i < ids.length; i++) {
     
      var notas = new Array();
notas.push($("#n1"+ids[i]).val());
notas.push($("#n2"+ids[i]).val());
notas.push($("#n3"+ids[i]).val());
notas.push($("#n4"+ids[i]).val());
notas.push($("#n5"+ids[i]).val());
notas.push($("#n6"+ids[i]).val());
notas.push($("#n7"+ids[i]).val());
notas.push($("#n8"+ids[i]).val());
notas.push($("#n9"+ids[i]).val());

notasXid.push(notas);
//alert(notasXid);
notas= [];

//

                                      }



                                      $.ajax({  url: "clases/all.php",
              type: "POST",
              dataType: "json",
              data: {n:notasXid,ids:ids},
          })
      .done(function(data) {
        alert("Datos guardados con exito");
        verCargas2(plantilla,periodo);
            
    });


     
  

})

});

 
