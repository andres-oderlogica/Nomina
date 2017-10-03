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
		if (empty($_POST['nombre_completo'])){
			$errors[] = "Nombres vacíos";
	//	} elseif (empty($_POST['lastname'])){
		//	$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['user_name'])) {
            $errors[] = "Nombre de usuario vacío";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $errors[] = "Nombre de usuario no encaja en el esquema de nombre: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        } elseif (empty($_POST['user_email'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['user_email']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
        } elseif (
			!empty($_POST['user_name'])
			&& !empty($_POST['nombre_completo'])
			//&& !empty($_POST['lastname'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            require_once ("../config/db.php");
			require_once ("../config/conexion.php");
			
				
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_completo"],ENT_QUOTES)));
				$dir = mysqli_real_escape_string($con,(strip_tags($_POST["direccion"],ENT_QUOTES)));
                $tel = mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
                $perfil = mysqli_real_escape_string($con,(strip_tags($_POST["cod_perfil"],ENT_QUOTES)));
                $identi = mysqli_real_escape_string($con,(strip_tags($_POST["identificacion"],ENT_QUOTES)));
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email"],ENT_QUOTES)));
				$user_password = $_POST['user_password_new'];
				$date_added=date("Y-m-d H:i:s");
                
				$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
					
                
                $sql = "SELECT * FROM docente WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = mysqli_query($con,$sql);
				$query_check_user=mysqli_num_rows($query_check_user_name);
                if ($query_check_user == 1) {
                    $errors[] = "Lo sentimos , el nombre de usuario ó la dirección de correo electrónico ya está en uso.";
                } else {
					// write new user's data into database
                  /*  $sql = "INSERT INTO docente (cod_perfil, user_name, user_password_hash, user_email, date_added, identificacion, nombre_completo, direccion, telefono)
                            VALUES('".$perfil."','" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "','".$date_added."','".$identi."','".$firstname."','".$dir."','".$tel."');";
                    $query_new_user_insert = mysqli_query($con,$sql);*/

                            $reg              = new Docente('docente');                            
                            $reg->cod_perfil      = $perfil;
                            $reg->user_name       = $user_name;
                            $reg->user_password_hash = $user_password_hash;
                            $reg->user_email = $user_email;
                            $reg->date_added = $date_added;
                            $reg->identificacion      = $identi;
                            $reg->nombre_completo = $firstname;
                            $reg->direccion = $dir;
                            $reg->telefono = $tel;                          
                            $reg->Save();                            
                            $query_new_user_insert = $reg->id_docente;

                    // if user has been added successfully
                    if (!empty($query_new_user_insert)) {
                        $messages[] = "La cuenta ha sido creada con éxito.";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                }
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
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
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>