<?php
extract($_POST);
include_once 'estudiante.php';
$disc       = new regEstudiante();	

try
{
	$disc->reg_estudiante($codigo,$identificacion,$primer_apellido,$segundo_apellido,$primer_nombre,$segundo_nombre,$direccion,$telefono,$email,$discapacidad,$fecha_nacimiento, $usuario);
	//var_dump($codigo);
      echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>