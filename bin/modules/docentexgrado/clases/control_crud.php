<?php
include_once 'docentexgrado.php';
$opcion = $_POST['opcion'];
$mxg     = $_POST['mxg'];
$docente    = $_POST['docente'];
$anio   = $_POST['anio'];
$id = $_POST['id'];
$disc   = new regDocentexgrado();
//var_dump($id);
switch ($opcion) {
	case '1':
	try {
		$disc->eliminar($id);
		echo json_encode(array('eliminado' => TRUE));
		
	} catch (Exception $ex) {
		echo json_encode(array('eliminado' => FALSE));
		
	}		
		break;
	case '2':	
		$res = $disc->buscar($id);
		echo json_encode($res);		
		break;
		case '3':
			$disc->desvincular($idEdit);
			break;
			case '4':
			//var_dump($docente);
				$ultimo_materia_organizada=$disc->reg_materia_organizada($mxg,$docente, $anio);
				
			try {
                $cod_grado=$disc->identificar_grado($mxg);
                $periodos=$disc->listar_periodos();
                $estudiantes=$disc->buscar_id_estudiantesxgrado($cod_grado);

                for ($i=0; $i <count($estudiantes); $i++)
					{ 

					for ($j=0; $j <count($periodos); $j++) 
					  { 
					    
					    $disc->regristrar_plantilla($estudiantes[$i],$ultimo_materia_organizada,$periodos[$j]);

					  }

					}

					echo json_encode('Excepción capturada: ');
				} catch (Exception $ex) {
						echo json_encode($ex->getMessage());
										
									}


				//echo json_encode($disc);
				//$disc->cambiarEstado("1",$id_estudiante);
				break;
		case '5':
		     //var_dump($id_estudiante);
			$disc->crear_plantilla_de_notas($id_estudiante);
			break;
			case '6':
				$disc->inactivarMateriaDocente($id, 2);
					try {
		
						echo json_encode(array('editado' => TRUE));
						
					} catch (Exception $ex) {
						echo json_encode(array('editado' => FALSE));
						
					}
				break;
				case '7':
				$disc->inactivarMateriaDocente($id, 1);
					try {
		
						echo json_encode(array('editado' => TRUE));
						
					} catch (Exception $ex) {
						echo json_encode(array('editado' => FALSE));
						
					}
				break;
				case '8':
				    $anterior = $disc->buscarAnterior($mxg);
				    if($anterior == 'NULL'){
				    	echo json_encode(array('editado' => FALSE));
				    }
				    else{
								$idUltimo = $disc->reg_materia_organizada($mxg,$docente, $anio);								
								try {
									$disc->buscarPlantilla($anterior,$idUltimo);
									echo json_encode(array('editado' => TRUE));
									
								} catch (Exception $ex) {
									echo json_encode(array('editado' => FALSE));
									
								}

					 }
                        
					break;
	default:
		# code...
		break;
}

?>