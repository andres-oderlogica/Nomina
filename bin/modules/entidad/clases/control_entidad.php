<?php
extract($_POST);
include_once 'entidad.php';
$disc       = new regEntidad();
try
{
	$disc->reg_entidad($codigo, $nombre_entidad);
	echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>
