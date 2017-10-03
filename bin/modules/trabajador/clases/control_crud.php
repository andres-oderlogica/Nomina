<?php
include_once 'trabajador.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$codigo =$_POST['codigo'];
$idtipo = $_POST['id_tipodocumento'];
$documento    = $_POST['documento'];
$primer_apellido   = $_POST['primer_apellido'];
$segundo_apellido  = $_POST['segundo_apellido'];
$primer_nombre = $_POST['primer_nombre'];
$segundo_nombre = $_POST['segundo_nombre'];
$barrio =$_POST['barrio'];
$direccion    = $_POST['direccion'];
$telefono_fijo    = $_POST['telefono_fijo'];
$celular = $_POST['celular'];
$email   = $_POST['email'];
$estado = $_POST['estado'];
//extract($_POST);
$disc   = new regTrabajador();
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

			$disc->editar($codigo,$id_tipodocumento,$documento,$primer_nombre,$segundo_nombre,$primer_apellido,
			                                $segundo_apellido,$direccion,$barrio,$telefono_fijo,$celular,$email, $estado);
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
