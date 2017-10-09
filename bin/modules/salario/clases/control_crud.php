<?php
include_once 'salario.php';
$opcion = $_POST['opcion'];
$id     = $_POST['id'];
$descripcion =$_POST['descripcion'];
$valor = $_POST['valor'];
$salud    = $_POST['salud'];
$pension   = $_POST['pension'];
$primas  = $_POST['primas'];
$cesantias = $_POST['cesantias'];
$transporte = $_POST['transporte'];
$ahorro =$_POST['ahorro'];
$asociacion    = $_POST['asociacion'];
$cooperativa    = $_POST['cooperativa'];
$caja = $_POST['caja'];
$arl   = $_POST['arl'];
$comisiones = $_POST['comisiones'];
$otros = $_POST['otros'];
//extract($_POST);
$disc   = new regSalario();
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
			$disc->editar($id,$descripcion,$valor,$transporte,$salud,$pension,$asociacion,
			                       $cooperativa,$cesantias,$primas,$ahorro,$comisiones,$otros,$caja, $arl);
			break;

		case '4':
			try {
					if($estado == 1){
						$disc->editarEstado($id, 2);
					}
					if($estado == 2){
						$disc->editarEstado($id, 1);
					}


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
