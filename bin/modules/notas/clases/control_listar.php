<?php
include_once 'matricula.php';
$disc       = new regMatricula();
$opcion  = $_POST['opcion'];
$plantilla   = $_POST['plantilla'];
$periodo   = $_POST['periodo'];
switch ($opcion) {
	case '1':
		echo $disc->listMatricula();
		break;
	case '2':
		//echo $disc->listMatriculados2($plantilla,$periodo);
	$res=$disc->listMatriculados2($plantilla,$periodo);
	//var_dump($res);
	echo  json_encode($res);
		break;
	default:
		# code...
		break;
}

?>