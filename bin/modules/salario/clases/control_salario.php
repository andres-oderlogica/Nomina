<?php
extract($_POST);
include_once 'Salario.php';
$disc       = new regSalario();

try
{
	$disc->reg_salario($descripcion_salario,$valor_salario,$aux_transporte,$desc_salud,
										$desc_pension,$desc_asociacion,$desc_cooperativa,$cesantias,$primas,
										$ahorros,$comisiones,$caja_compensacion, $otros, $arl);
	//var_dump($codigo);
      echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>
