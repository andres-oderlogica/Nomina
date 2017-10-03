<?php
extract($_POST);
include_once 'docente.php';
$disc       = new regDocente();	
try
{
	$disc->reg_docente($identificacion, $nombre_completo, $direccion, $telefono, $correo);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>