<?php
extract($_POST);
include_once 'gradoxmateria.php';
$disc       = new regGradoxmateria();	
		try
		{
		  foreach($servicios as $campo => $valor)
				{
				$disc->reg_gradoxmateria($valor,$cod_grado);
				}
				echo json_encode(array('guardado' => TRUE));			
		}
		catch (Exception $ex)
		{
			 echo json_encode(array('guardado' => FALSE));
		}
?>