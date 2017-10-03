$(document).ready(function($){

function validaNumeros(campo, valor)
{
$(campo).on('change click keyup input paste', function(){
if (!/^([0-9.])*$/.test($(this).val())){
       bootbox.alert("El valor " + $(this).val() + " no es un número");
    this.value = valor;
    $(this).select();
}
});

}

validaNumeros('#precio', 0)
validaNumeros('#existencias', 1)
validaNumeros('#iva', 0)


});