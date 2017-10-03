<?php
include_once 'gradoxmateria.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];

$disc   = new regGradoxmateria();
//var_dump($id);
switch ($opcion) {
	case '1':
	try {
		$disc->eliminar($id);
		echo json_encode(array('eliminado' => TRUE));
		
	} catch (Exception $ex) {
		echo json_encode(array('eliminado' => FALSE));
		
	}		
		break;
	
	default:
		# code...
		break;
}

?>