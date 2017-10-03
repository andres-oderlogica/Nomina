<?php
include_once 'matricula.php';
$disc       = new regMatricula();
$opcion  = $_POST['opcion'];
$docente   = $_POST['docente'];
//var_dump($docente);
switch ($opcion) {
	case '1':
		echo $disc->listMatricula();
		break;
	case '2':
		echo $disc->materias($docente);
		break;
	default:
		# code...
		break;
}

?>