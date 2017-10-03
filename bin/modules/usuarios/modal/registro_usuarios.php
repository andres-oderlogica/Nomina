	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_usuario" name="guardar_usuario">
			<div id="resultados_ajax"></div>
			<div class="form-group">
				<label for="firstname" class="col-sm-3 control-label">Identificacion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Identificacion" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="firstname" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Nombres" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="lastname" class="col-sm-3 control-label">Direccion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
				</div>
			  </div>
			   <div class="form-group">
				<label for="lastname" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono">
				</div>
			  </div>
			 
			  <div class="form-group">
				<label for="user_email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Correo electrónico">
				</div>
			  </div>
			   <div class="form-group">
				<label for="user_name" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_password_new" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_new" name="user_password_new" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_password_repeat" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="user_password_repeat" name="user_password_repeat" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>
			  <div class="form-group">
			  	<label for="perfil" class="col-sm-3 control-label">Perfil</label>
			  	<div class="col-sm-8">
			    <label for="admin" class="radio-inline"> <input name="cod_perfil" type="radio" id="admin" value="2" />Admin</label>
                <label for="doc" class="radio-inline"><input name="cod_perfil" type="radio" id="doc" value="1" checked/>Docente</label>
                <label for="otro" class="radio-inline"> <input name="cod_perfil" type="radio" id="otro" value="3" />Boletines</label>
                <label for="otro" class="radio-inline"> <input name="cod_perfil" type="radio" id="consolidado" value="4" />Consolidado</label>
                <!--<label for="cdosII" class="radio-inline">  <input name="cod_perfil" type="radio" id="cdosII" value="4" />Corte 2 / SemestreII</label>-->
			 </div>
			  </div>
			  

			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>