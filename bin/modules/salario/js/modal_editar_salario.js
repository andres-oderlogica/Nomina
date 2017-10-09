$(document).ready(function() {


$("#btn_save").click(function(){
	$.ajax({
    url: "clases/control_crud.php",
    type: "POST",
    dataType: "json",
    data: {opcion:"3",
		id:$('#modal_id').val(),
		descripcion:$('#descripcion_salario').val(),
		valor:$('#valor_salario').val(),
		transporte:$('#aux_transporte').val(),
		salud:$('#desc_salud').val(),
		pension:$('#desc_pension').val(),
		cooperativa:$('#desc_cooperativa').val(),
		asociacion:$('#desc_asociacion').val(),
		primas:$('#primas').val(),
		cesantias:$('#cesantias').val(),
		caja:$('#caja_compensacion').val(),
		otros:$('#otros').val(),
		arl:$('#arl').val(),
		ahorro:$('#ahorros').val(),
		comisiones:$('#comisiones').val(),
    },
          })
      .done(function() {
             })
      .always(function(){
        $('#myModal').modal('toggle');
      parent.verCargas();

      })

    });



})
