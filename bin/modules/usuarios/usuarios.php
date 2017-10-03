<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
        require_once ("../config/db.php");
	require_once ("../config/conexion.php");
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   <?php //include("../plantilla/head.php");?>
  <title>Usuarios</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
 <!-- <script src='js/matricula.js?v=<?php //echo str_replace('.', '', microtime(true)); ?>'></script>

  <script src='js/modal_editar_docente.js?v=<?php// echo str_replace('.', '', microtime(true)); ?>'></script>-->
  <script type="text/javascript" src="js/usuarios.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="../plantilla2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/skins/skin-blue.min.css">
  <script src="../plantilla2/dist/js/app.min.js"></script>
  <style>
            
         
            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable2_paginate{
                text-align: -webkit-center;
                float: right;
                 margin: 0;
            }
            #myTable_info{
                font-weight: bold;
            }
            #myTable2_info{
                font-weight: bold;
            }
          /*  .panel-body {
            height: 500px;
            }*/
   
        </style>
   </head>
<body class="hold-transition skin-blue sidebar-mini">
    <?php
    
   include '../plantilla2/starter.php';
      
  ?>  
    <!--<div class="container">-->
		<div class="panel panel-primary">
		<div class="panel-heading">
		 
			<h4> Administrar Usuarios</h4>
			
		</div>		
          
			
			<div class="panel-body">
			<?php
			include("/modal/registro_usuarios.php");
			include("/modal/editar_usuarios.php");
			include("/modal/cambiar_password.php");
			?>


			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Nombres:</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
							</div>
							<button type='button' class="btn btn-primary" data-toggle="modal" data-target="#myModal"></span> Nuevo Usuario</button>

							
							
							<div class="col-md-3">
								<!--<button type="button" class="btn btn-default" onclick='load(1);'>-->
									<!--<span class="glyphicon glyphicon-search" ></span> Buscar</button>-->
								<span id="loader"></span>
							</div>
							
						</div>
				
				</div>	
				
			</form>
			
				<div id="resultados"></div>
				<div class='outer_div'></div>

						
			
</div>


	

	<!--</div>-->
	<?php
include '../plantilla2/fin.php';

?>
	


	<!--<script type="text/javascript" src="js/usuarios.js"></script>-->

		


  </body>
</html>
<script>
$( "#guardar_usuario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "nuevo_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_usuario" ).submit(function( event ) {
  $('#actualizar_datos2').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "editar_usuario.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos2').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

$( "#editar_password" ).submit(function( event ) {
  $('#actualizar_datos3').attr("disabled", true);
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "editar_password.php",
			data: parametros,
			 beforeSend: function(objeto){
				$("#resultados_ajax3").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax3").html(datos);
			$('#actualizar_datos3').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})
	function get_user_id(id){
		$("#user_id_mod").val(id);
	}

	function obtener_datos(id){
			var nombres = $("#nombres"+id).val();
			var identificacion = $("#identificacion"+id).val();
			var direccion = $("#direccion"+id).val();
			var telefono = $("#telefono"+id).val();
			var usuario = $("#usuario"+id).val();
			var email = $("#email"+id).val();
			var perfil = $('#cod_perfil'+id).val();
			
			$("#mod_id2").val(id);
			$("#nombre_completo2").val(nombres);
			$("#identificacion2").val(identificacion);
			$("#direccion2").val(direccion);
			$("#telefono2").val(telefono);
			$("#user_name2").val(usuario);
			$("#user_email2").val(email);
			$("#perDef").val(perfil);
			
		}
</script>