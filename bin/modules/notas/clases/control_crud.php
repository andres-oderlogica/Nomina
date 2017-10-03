<?php
include_once 'matricula.php';
$opcion = $_POST['opcion'];
$id_estudiante     = $_POST['id_estudiante'];
$id_grado    = $_POST['id_grado'];
$id_jornada   = $_POST['id_jornada'];
$id_docente    = $_POST['id_docente'];
$desde    = $_POST['desde'];
$hasta    = $_POST['hasta'];
$estado   = $_POST['estado'];
$idEdit   = $_POST['estudiante'];
$disc   = new regMatricula();
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
				$disc->reg_matricula($id_estudiante,$id_grado, $id_jornada, $id_docente, $desde, $hasta, $estado);
				$disc->cambiarEstado("1",$id_estudiante);
				break;

				case '5':	//var_dump($_POST['id'],$_POST['n1'],$_POST['n2'],$_POST['n3'],$_POST['n4'],$_POST['n5'],$_POST['n6'],$_POST['n7'],$_POST['n8'],$_POST['n9'],$_POST['n10'],$_POST['n11'],$_POST['n12']);
		$res = $disc->actualizar($_POST['n1'],$_POST['n2'],$_POST['n3'],$_POST['n4'],$_POST['n5'],$_POST['n6'],$_POST['n7'],$_POST['n8'],$_POST['n9'],$_POST['id']);
		echo json_encode($res);		
		break;
	default:
		# code...
		break;
}

?>