function tabla(data){
$.ajax({

	url:"../controllers/control_productos.php",
	type:"POST",
	dataType: "json",
	data:{accion:"tabla", data:data},
})
.done(function(res) {
        // console.log(res);  
         $("#contenido").html(res);    
        
    });

}

function eliminar(id){ 
	bootbox.confirm("Desea eliminar el registro?", function(result) {
 if(result){
$.ajax({
              url: "../controllers/control_productos.php",
              type: "POST",
              dataType: "json",
              data: {accion:"borrar",
                     id:id},
          })
      .done(function() {         
        
    });
      bootbox.alert("Se elimino el registro con exito", function(){ 
                                 tabla("")
                                })
  }
})
}

function editar(id)
{
	
	
	$.ajax({
              url: "../controllers/control_productos.php",
              type: "POST",
              dataType: "json",
              data: {accion:"buscar",
                     id:id},
          })
      .done(function(data) {
      //console.log(data) 
    $("#modal_id").val(data.id_producto);
    $("#modal_codigo").val(data.codigo);
	$("#modal_descripcion").val(data.descripcion);
	$("#modal_precio").val(data.precio);
	$("#modal_existencias").val(data.existencias);
	$("#modal_iva").val(data.iva);
        
    });
      

     
}

$(document).ready(function() {
$('#codigo').focus();
$('#codigo').select();
//$('#save').prop('disabled', true);
var valor;
tabla("");

 (function($) {
    $.fn.onEnter = function(func) {
        this.bind('keypress', function(e) {
            if (e.keyCode == 13) func.apply(this, [e]);    
        });               
        return this; 
     };
})(jQuery);


function guardarDatos()
{
  if($('#codigo').val() == "" || $('#descripcion').val() == "" || $('#precio').val() == "")
  {
    bootbox.alert("Hay datos Obligatorios", function(){ 
                                   
                                })
  }
  else
  {
	$.ajax({
    url: "../controllers/control_productos.php",
    type: "POST",
    dataType: "json",
    data: {accion:"registrar",
    codigo:$('#codigo').val(), 
    descripcion:$('#descripcion').val(),
    precio:$('#precio').val(),
    existencias:$('#existencias').val(),
    estado:1,
    iva:$('#iva').val()},
          })
      .done(function() {               
             });
       	 bootbox.alert("Se guardo el registro con exito", function(){ 
                                tabla("")   
                                })
       	 $('#codigo').val("") 
         $('#descripcion').val("")
         $('#precio').val("0")
         $('#existencias').val("1")
         $('#iva').val("0")

       }

}

$('#codigo').onEnter(function(){  
    $('#descripcion').select();    
    });

$('#descripcion').onEnter(function(){  
    $('#precio').select();    
    });

$('#precio').onEnter(function(){  
    $('#existencias').select();    
    });

$('#existencias').onEnter(function(){  
    $('#iva').select();
    //$('#save').prop('disabled', false);    
    });

$('#iva').onEnter(function(){  
    guardarDatos()   
    });


function mayusculas(field){
$(function() {
    $(field).keyup(function() {
        this.value = this.value.toUpperCase();
    });
});
}

mayusculas('#descripcion')


$('#buscar').keyup(function () {      
            var value = $(this).val();    
            tabla(value)
            }) 



 $("#save").click(function(){
 guardarDatos()	
})   

})