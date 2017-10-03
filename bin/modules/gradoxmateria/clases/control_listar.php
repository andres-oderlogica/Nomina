<?php
include_once 'gradoxmateria.php';
$disc       = new regGradoxmateria();
$opcion  = $_POST['opcion'];
$grado   = $_POST['grado'];
switch ($opcion) {
	case '1':
		echo $disc->listmateriaxgrado($grado);
		break;
	
	default:
		# code...
		break;
}

?>