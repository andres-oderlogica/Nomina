<?php
include_once 'docentexgrado.php';
$opcion = $_POST['opcion'];
$mxg     = $_POST['mxg'];
$docente    = $_POST['docente'];
$anio   = $_POST['anio'];
$id = $_POST['id'];
$disc   = new regDocentexgrado();
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
			$disc->desvincular($idEdit);
			break;
			case '4':
			//var_dump($docente);
				$disc->reg_materia_organizada($mxg,$docente, $anio);
				//echo json_encode($disc);
				//$disc->cambiarEstado("1",$id_estudiante);
				break;
		case '5':
		     //var_dump($id_estudiante);
			$disc->crear_plantilla_de_notas($id_estudiante);
			break;
	default:
		# code...
		break;
}

?>