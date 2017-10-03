<?php
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	include('../../../is_logged.php');
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$user_id=intval($_GET['id']);
		$query=mysqli_query($con, "select * from docente where id_docente='".$user_id."'");
		$rw_user=mysqli_fetch_array($query);
		$count=$rw_user['user_id'];
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM docente WHERE id_docente='".$user_id."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados .
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Ocurrio un error
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puede eliminar administrador. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_completo', 'identificacion');
		 $sTable = "docente";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by id_docente desc";
		include 'pagination.php'; 

		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = 'usuarios.php';
		
		$sql="SELECT * FROM  $sTable $sWhere LIMIT 7000";
		$query = mysqli_query($con, $sql);
		
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr>
					<th>#</th>
					<th><span class="pull-center">Nombres</span></th>
					<th><span class="pull-center">User</span></th>
					<th><span class="pull-center">Correo Electronico</span></th>
					<th><span class="pull-center">Telefono</span></th>
					<th><span class="pull-center">Accion</span></th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$user_id=$row['id_docente'];
						//$fullname=$row['nombre_completo']." ".$row["lastname"];
						$fullname=$row['nombre_completo'];
						$user_name=$row['user_name'];
						$user_email=$row['user_email'];
						//$date_added= date('d/m/Y', strtotime($row['date_added']));
						$date_added=$row['telefono'];
						
					?>
					
					<input type="hidden" value="<?php echo $row['nombre_completo'];?>" id="nombres<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $row['identificacion'];?>" id="identificacion<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $row['direccion'];?>" id="direccion<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $row['telefono'];?>" id="telefono<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $row['cod_perfil'];?>" id="cod_perfil<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_name;?>" id="usuario<?php echo $user_id;?>">
					<input type="hidden" value="<?php echo $user_email;?>" id="email<?php echo $user_id;?>">
				
					<tr>
						<td><?php echo $user_id; ?></td>
						<td><?php echo $fullname; ?></td>
						<td ><?php echo $user_name; ?></td>
						<td ><?php echo $user_email; ?></td>
						<td><?php echo $date_added;?></td>
						
					<td ><span class="pull-right">
					<a href="#" class='btn btn-primary' title='Editar usuario' onclick="obtener_datos('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-pencil"></i></a> 
					<a href="#" class='btn btn-success' title='Cambiar contraseña' onclick="get_user_id('<?php echo $user_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-lock"></i></a>
					<!--<a href="#" class='btn btn-danger' title='Borrar usuario' onclick="eliminar('<? //echo $user_id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>-->
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>