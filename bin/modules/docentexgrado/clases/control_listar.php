<?php
include_once 'docentexgrado.php';
$disc       = new regDocentexgrado();
$opcion  = $_POST['opcion'];
$docente   = $_POST['docente'];
$idm = $_POST['idm'];
switch ($opcion) {
	case '1':
		echo $disc->listDocentexgrado();
		break;
	case '2':
		echo $disc->listMatriculados($idm);
		break;
	default:
		# code...
		break;
}

?>