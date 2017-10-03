<?php
extract($_POST);
include_once 'grado.php';
$disc       = new regGrado();	
try
{
	$disc->reg_grado($descripcion, $letra, $numero);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>