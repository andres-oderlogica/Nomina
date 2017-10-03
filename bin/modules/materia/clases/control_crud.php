<?php
include_once 'materia.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$desc   = $_POST['desc'];
$cod    = $_POST['codigo'];
$disc   = new regMateria();

switch ($opcion) {
	case '1':
	try {
		$disc->eliminar($id);
		echo json_encode(array('eliminado' => TRUE));
		
	} catch (Exception $ex) {
		echo json_encode(array('eliminado' => FALSE));
		
	}		
		break;
	case '2':	
		$res = $disc->buscar($id);
		echo json_encode($res);		
		break;
		case '3':
		//var_dump($opcion,$id,$cod,$desc);
			$disc->editar($id,$cod,$desc);
			break;
	default:
		# code...
		break;
}

?>