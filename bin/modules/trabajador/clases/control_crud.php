<?php
include_once 'estudiante.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$codigo =$_POST['codigo'];
$identificacion    = $_POST['identificacion'];
$primer_apellido   = $_POST['primer_apellido'];
$segundo_apellido  = $_POST['segundo_apellido'];
$primer_nombre = $_POST['primer_nombre'];
$segundo_nombre = $_POST['segundo_nombre'];
$direccion    = $_POST['direccion'];
$telefono    = $_POST['telefono'];
$email   = $_POST['email'];
$discapacidad = $_POST['discapacidad'];
$usuario = $_POST['usuario'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$estado = $_POST['estado'];
//extract($_POST);
$disc   = new regEstudiante();
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

			$disc->editar($id,$codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento, $usuario);
			break;
	
		case '4':
			try {
					$disc->editarEstadoPago($id, $estado);
					echo json_encode(array('editado' => TRUE));
					
				} catch (Exception $ex) {
					echo json_encode(array('editado' => FALSE));
					
				}	
			break;

			case '5':
			try {
					$disc->editarEstadoPago($id, $estado);
					echo json_encode(array('editado' => TRUE));
					
				} catch (Exception $ex) {
					echo json_encode(array('editado' => FALSE));
					
				}	
			break;
}

?>