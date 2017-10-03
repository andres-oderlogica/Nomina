<?php
include('../../../is_logged.php');
include('../../../core.php');
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Docente extends ADOdb_Active_Record{}
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    
    require_once("../../../lib/password_compatibility_library.php");
}		
		if (empty($_POST['user_id_mod'])){
			$errors[] = "ID vacío";
		}  elseif (empty($_POST['user_password_new3']) || empty($_POST['user_password_repeat3'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['user_password_new3'] !== $_POST['user_password_repeat3']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        }  elseif (
			 !empty($_POST['user_id_mod'])
			&& !empty($_POST['user_password_new3'])
            && !empty($_POST['user_password_repeat3'])
            && ($_POST['user_password_new3'] === $_POST['user_password_repeat3'])
        ) {
            require_once ("../config/db.php");
			require_once ("../config/conexion.php");
			
				$user_id=intval($_POST['user_id_mod']);
				$user_password = $_POST['user_password_new3'];
				
                
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
               
					
                   /* $sql = "UPDATE docente SET user_password_hash='".$user_password_hash."' WHERE user_id='".$user_id."'";
                    $query = mysqli_query($con,$sql);*/

                   			$reg              = new Docente('docente');
					        $reg->load("id_docente = {$user_id}");
					        $reg->user_password_hash      = $user_password_hash;
					        $reg->Save();
					        $query = $reg ->id_docente;

                    if (!empty($query)) {
                        $messages[] = "Se ha cambiado la contraseña";
                    } else {
                        $errors[] = "Registro fallido";
                    }
                
            
        } else {
            $errors[] = "error desconocido";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong></strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>