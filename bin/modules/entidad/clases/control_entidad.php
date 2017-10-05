<?php
extract($_POST);
include_once 'materia.php';
$disc       = new regMateria();	
try
{
	$disc->reg_materia($codigo, $descripcion);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>