<?php
include_once 'docente.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$identificacion    = $_POST['identificacion'];
$nombre   = $_POST['nombre_completo'];
$direccion    = $_POST['direccion'];
$telefono    = $_POST['telefono'];
$correo    = $_POST['correo'];
$disc   = new regDocente();
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
	case '2':	
		$res = $disc->buscar($id);
		echo json_encode($res);		
		break;
		case '3':
			$disc->editar($id,$identificacion,$nombre, $direccion, $telefono, $correo);
			break;
	default:
		# code...
		break;
}

?>