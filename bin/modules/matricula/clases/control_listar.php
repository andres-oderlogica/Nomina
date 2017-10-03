<?php
include_once 'matricula.php';
$disc       = new regMatricula();
$opcion  = $_POST['opcion'];
$grado   = $_POST['grado'];
switch ($opcion) {
	case '1':
		echo $disc->listMatricula();
		break;
	case '2':
		echo $disc->listMatriculados($grado);
		break;
	default:
		# code...
		break;
}

?>