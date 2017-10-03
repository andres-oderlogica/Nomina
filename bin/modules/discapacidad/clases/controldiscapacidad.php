<?php
extract($_POST);
include_once 'discapacidad.php';
$disc       = new regdiscapacidad();	
try
{
	$id_carga   = $disc->reg_discapacidad($descripcion);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>