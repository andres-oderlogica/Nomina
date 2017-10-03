<?php
extract($_POST);
include_once 'matricula.php';
$disc       = new regDocente();	
try
{
	$disc->reg_matricula($id_estudiante,$id_grado, $id_jornada, $desde, $hasta, $estado);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>