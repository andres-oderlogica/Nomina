<?php
extract($_POST);
include_once 'trabajador.php';
$disc       = new regTrabajador();

try
{
	$disc->reg_estudiante($codigo,$id_tipodocumento,$documento,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,$direccion,$barrio,$telefono_fijo,$celular,$email, $estado);
	//var_dump($codigo);
      echo json_encode(array('guardado' => TRUE));
}
catch (Exception $ex)
{
	 echo json_encode(array('guardado' => FALSE));
}
?>
