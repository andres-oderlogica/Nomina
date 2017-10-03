<?php
//die('Sitio fuera de linea ');
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {    
    require_once("lib/password_compatibility_library.php");
}
require_once("bin/modules/config/db.php");
require_once("login/Login.php");
$login = new Login();

if ($login->isUserLoggedIn() == true) {    
   header("location: bin/modules/index/inicio.php");

} else {
 
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Colegio</title>

	<link rel="stylesheet" href="lib/bootstrap.min.css">
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   <script src="lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script  type="text/javascript" src="boletin.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"> </script>
</head>
<body>
 <div class="container">
        <div class="card card-container">
            <!--<img id="profile-img" class="profile-img-card" src="img/user.png" />-->
            <center><h1>Iniciar Sesión</h1></center>
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong></strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong></strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
                <span id="reauth-email" class="reauth-email"></span>


                <label>Usuario</label>
                <input class="form-control" placeholder="Usuario" name="user_name" type="text" value="" autofocus="" required>
                <label>Contraseña</label>
                <input class="form-control" placeholder="password" name="user_password" type="password" value="" autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">Ingresar</button>
            </form><!-- /form -->
            
        </div>
            


      <!--   <div class="card card-container">
          <img id="profile-img" class="profile-img-card" src="img/user.png" />
            <center><h1>Ver Boletin</h1></center>
            <p id="profile-name" class="profile-name-card"></p>
            <label>Digite el id del estudiante</label>
                <input class="form-control"  id="id_estudiante" type="text">
                <div id="boton"></div>
            
        </div> /card-container -->
    </div><!-- /container -->
  </body>
</html>

	<?php
}


