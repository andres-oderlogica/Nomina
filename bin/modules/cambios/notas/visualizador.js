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

            $('#ver_cargas2').html(datos);
           
            $('#myTable2').DataTable({
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
            pag_data_table2();
        }
    });
}



});