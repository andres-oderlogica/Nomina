$(document).ready(function(){

   	$("#id_estudiante").blur(function(){
    		var id_estudiante=$("#id_estudiante").val();
    		var user=$("#user").val();
$("#boton").html('<a href="bin/modules/boletines/generador_externo_por_estudiante.php?id_estudiante='+ id_estudiante+'&user='+user+'" target="_parent"><button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">generar</button></a><a href="bin/modules/notas/visualizador_padres.php?id_estudiante='+ id_estudiante+'"><button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">Visulizar Notas</button></a>'); 
	});


	$("#id_estudiante").focus(function(){
    		$("#boton").html('');
	});
});