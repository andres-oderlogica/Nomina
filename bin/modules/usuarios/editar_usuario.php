<?php
include('../../../is_logged.php');
include('../../../core.php');
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Docente extends ADOdb_Active_Record{}
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    
    require_once("../../../lib/password_compatibility_library.php");
}		
		if (empty($_POST['nombre_completo2'])){
			$errors[] = "Nombres vacíos";
		//} elseif (empty($_POST['lastname2'])){
		//	$errors[] = "Apellidos vacíos";
		}  elseif (empty($_POST['user_name2'])) {
            $errors[] = "Nombre de usuario vacío";
        }  elseif (strlen($_POST['user_name2']) > 64 || strlen($_POST['user_name2']) < 2) {
            $errors[] = "Nombre de usuario no puede ser inferior a 2 o más de 64 caracteres";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])) {
            $errors[] = "Nombre de usuario incorrecto: Sólo aZ y los números están permitidos , de 2 a 64 caracteres";
        } elseif (empty($_POST['user_email2'])) {
            $errors[] = "El correo electrónico no puede estar vacío";
        } elseif (strlen($_POST['user_email2']) > 64) {
            $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
        } elseif (!filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Su dirección de correo electrónico no es válida";
        } elseif (
			!empty($_POST['user_name2'])
			&& !empty($_POST['nombre_completo2'])
			//&& !empty($_POST['lastname2'])
            && strlen($_POST['user_name2']) <= 64
            && strlen($_POST['user_name2']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name2'])
            && !empty($_POST['user_email2'])
            && strlen($_POST['user_email2']) <= 64
            && filter_var($_POST['user_email2'], FILTER_VALIDATE_EMAIL)
          )
         {
            require_once ("../config/db.php");
			require_once ("../config/conexion.php");
			
				
                $firstname = mysqli_real_escape_string($con,(strip_tags($_POST["nombre_completo2"],ENT_QUOTES)));
				$identi = mysqli_real_escape_string($con,(strip_tags($_POST["identificacion2"],ENT_QUOTES)));
				$dir = mysqli_real_escape_string($con,(strip_tags($_POST["direccion2"],ENT_QUOTES)));
				$tel = mysqli_real_escape_string($con,(strip_tags($_POST["telefono2"],ENT_QUOTES)));
				$perfil = mysqli_real_escape_string($con,(strip_tags($_POST["cod_perfil2"],ENT_QUOTES)));
				$perDef = mysqli_real_escape_string($con,(strip_tags($_POST["perDef"],ENT_QUOTES)));
				$user_name = mysqli_real_escape_string($con,(strip_tags($_POST["user_name2"],ENT_QUOTES)));
                $user_email = mysqli_real_escape_string($con,(strip_tags($_POST["user_email2"],ENT_QUOTES)));
				
				$user_id=intval($_POST['mod_id2']);
				if(empty($perfil)){
					$perfilReal = $perDef;
				}
				else{
					$perfilReal = $perfil;
				}
					
               /*
                    $sql = "UPDATE docente SET cod_perfil='".$perfil."', user_name='".$user_name."', user_email='".$user_email."', nombre_completo='".$firstname."', identificacion='".$identi."', direccion = '".$dir."', direccion = '".$tel."' 
                            WHERE id_docente='".$user_id."';";
                    $query_update = mysqli_query($con,$sql);*/                
  // var_dump($user_id);
					        $reg              = new Docente('docente');
					        $reg->load("id_docente = {$user_id}");
					        $reg->cod_perfil      = $perfilReal;
					        $reg->user_name       = $user_name;
					        $reg->user_email = $user_email;
					        $reg->identificacion      = $identi;
					        $reg->nombre_completo = $firstname;
					        $reg->direccion = $dir;
					        $reg->telefono = $tel;					        
					        $reg->Save();
					        $query_update = true;
   
                    if ($query_update) {
                        $messages[] = "La cuenta ha sido editado.";
                    } else {
                        $errors[] = "El registro falló. Por favor, regrese y vuelva a intentarlo.";
                    }
                
            
        } else {
            $errors[] = "Error desconocido.";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong></strong> 
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