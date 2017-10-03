	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar usuario</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">
			<div id="resultados_ajax2"></div>
			<div class="form-group">
				<label for="identificacion2" class="col-sm-3 control-label">Identificacion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="identificacion2" name="identificacion2" placeholder="Identificacion">
				  
				</div>
			  </div>
			<div class="form-group">
				<label for="firstname2" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_completo2" name="nombre_completo2" placeholder="Nombres" required>
				  <input type="hidden" id="mod_id" name="mod_id">
				</div>
			  </div>
			  <div class="form-group">
				<label for="direccion2" class="col-sm-3 control-label">Direccion</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="direccion2" name="direccion2" placeholder="Direccion">
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono2" class="col-sm-3 control-label">Telefono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono2" name="telefono2" placeholder="Telefono">
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_name2" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="user_name2" name="user_name2" placeholder="Usuario" pattern="[a-zA-Z0-9]{2,64}" title="Nombre de usuario ( sólo letras y números, 2-64 caracteres)"required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="user_email2" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="user_email2" name="user_email2" placeholder="Correo electrónico" required>
				</div>
			  </div>
			  <input type="hidden" id="mod_id2" name="mod_id2">
			  <input type="hidden" id="perDef" name="perDef">
			  <div class="form-group">
			  	<label for="perfil" class="col-sm-3 control-label">Perfil</label>
			  	<div class="col-sm-8">
			  <label for="admin" class="radio-inline"> <input name="cod_perfil2" type="radio" id="admin" value="2" />Admin</label>
                <label for="doc" class="radio-inline"><input name="cod_perfil2" type="radio" id="doc" value="1" />Docente</label>
                <label for="otro" class="radio-inline"> <input name="cod_perfil2" type="radio" id="otro" value="3" />Boletines</label>
                <label for="otro" class="radio-inline"> <input name="cod_perfil2" type="radio" id="consolidado" value="4" />Consolidado</label>
				</div>
			  </div>		 	 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>