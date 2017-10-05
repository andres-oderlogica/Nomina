<?php
include_once 'entidad.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$desc   = $_POST['desc'];
$cod    = $_POST['codigo'];
$est    = $_POST['estado'];
$disc   = new regEntidad();

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
			case '4':
				if($est == 1){
				$disc->editarEstado($id,2);
			}
			else{
				$disc->editarEstado($id,1);
			}
				break;
	default:
		# code...
		break;
}

?>
