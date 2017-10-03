<?php
include_once '../utiles/pdf_helper.php';
include_once '../utiles/data_reports.php';
include_once '../utiles/code128.php';
include '../../../core.php';
include_once 'clases/boletin.php';


class Rep_Factura extends PDFReport  
{
	
	
 	public function Render($estudiante,$aMostrar,$curso,$corte)
	{
		$sumatoria=0;
		
		$this->Image("fondo.png", 0, 0, 280);
		$this->SetFont('Arial','',12);
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->Cell(110,5,"",0,0,'L');$this->Cell(5,5,"{$estudiante}",0,0,'L');//primer cero indica que no lleve borde
		$this->Ln();
		$this->EscC('');
		$this->EscC('');

		

		$this->Cell(13,5,"",0,0,'C');$this->Cell(20,5,"{$curso}",0,0,'C');
		$this->Ln();
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		
		$this->EscC('');
		$this->EscC('');
			
		$cantidad=count($aMostrar);
		for ($i	=0; $i	 < count($aMostrar); $i	++) { 

			//if($i=(count($aMostrar)-1)){$this->Ln();}

			if($i==$cantidad-1){
				$this->Ln();
				$this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"{$aMostrar[$i]['materia']}",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC1']}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC2']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['letraC2']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalIsemestre']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraIsemestre']}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC3']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC3']}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC4']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['letraC4']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalIIsemestre']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraIIsemestre']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['notaFinal']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraIFinal']}",0,0,'C');
				$this->Ln();
			}
			else
			{
				$this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"{$aMostrar[$i]['materia']}",0,0,'L');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC2']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC2']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC2']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['letraC2']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalIsemestre']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraIsemestre']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC3']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC3']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC3']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC3']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC4']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC4']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC4']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['letraC4']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalIIsemestre']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraIIsemestre']}",0,0,'C');$this->Cell(7,6,"{$aMostrar[$i]['notaFinal']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraFinal']}",0,0,'C');
			$this->Ln();
			

			}

			switch ($corte) {
				case 1:
					$sumatoriaC1I+=$aMostrar[$i]['finalC1'];
					break;
				case 2:
				    $sumatoriaC1I+=$aMostrar[$i]['finalC1'];
					$sumatoriaC2I+=$aMostrar[$i]['finalC2'];
					$sumatoriaSI+=$aMostrar[$i]['finalIsemestre'];
					break;
				case 3:
				$sumatoriaC1I+=$aMostrar[$i]['finalC1'];
					$sumatoriaC2I+=$aMostrar[$i]['finalC2'];
					$sumatoriaC1II+=$aMostrar[$i]['finalC3'];
					$sumatoriaSI+=$aMostrar[$i]['finalIsemestre'];
					break;
				case 4:
				$sumatoriaC1I+=$aMostrar[$i]['finalC1'];
					$sumatoriaC2I+=$aMostrar[$i]['finalC2'];
					$sumatoriaC1II+=$aMostrar[$i]['finalC3'];
					$sumatoriaC2II+=$aMostrar[$i]['finalC4'];
					$sumatoriaSI+=$aMostrar[$i]['finalIsemestre'];
					$sumatoriaSII+=$aMostrar[$i]['finalIIsemestre'];
					$sumatoriaFinal+=$aMostrar[$i]['notaFinal'];
					break;
				
			}
			




		}

		switch ($corte) {
			case 1:
					$promedioC1I=$sumatoriaC1I/(count($aMostrar));
		            //ceil($promedioC1I);
		            $boletin= new boletin();
        $letraPromedioC1I=$boletin->identificar_letra($promedioC1I);
        $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"Promedio",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1I),0,0,'C');$this->Cell(9,6,"{$letraPromedioC1I}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"",0,0,'C');$this->Cell(9,6,"",0,0,'C');
					break;
				case 2:
					$promedioC1I=$sumatoriaC1I/(count($aMostrar));
					$promedioC2I=$sumatoriaC2I/(count($aMostrar));
					$promedioSI=$sumatoriaSI/(count($aMostrar));
		            //ceil($promedioC1I);
		            $boletin= new boletin();
        $letraPromedioC1I=$boletin->identificar_letra($promedioC1I);
        $letraPromedioC2I=$boletin->identificar_letra($promedioC2I);
        $letraPromedioSI=$boletin->identificar_letra($promedioSI);
        $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"Promedio",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1I),0,0,'C');$this->Cell(9,6,"{$letraPromedioC1I}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC2I),0,0,'C');$this->Cell(11,6,"{$letraPromedioC2I}",0,0,'C');$this->Cell(9,6,ceil($promedioSI),0,0,'C');$this->Cell(9,6,"{$letraPromedioSI}",0,0,'C');

					break;
				case 3:
					$promedioC1I=$sumatoriaC1I/(count($aMostrar));
					$promedioC2I=$sumatoriaC2I/(count($aMostrar));
					$promedioSI=$sumatoriaSI/(count($aMostrar));
					$promedioC1II=$sumatoriaC1II/(count($aMostrar));
		            //ceil($promedioC1I);
		            $boletin= new boletin();
        $letraPromedioC1I=$boletin->identificar_letra($promedioC1I);
        $letraPromedioC2I=$boletin->identificar_letra($promedioC2I);
        $letraPromedioSI=$boletin->identificar_letra($promedioSI);
        $letraPromedioC1II=$boletin->identificar_letra($promedioC1II);
        $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"Promedio",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1I),0,0,'C');$this->Cell(9,6,"{$letraPromedioC1I}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC2I),0,0,'C');$this->Cell(11,6,"{$letraPromedioC2I}",0,0,'C');$this->Cell(9,6,ceil($promedioSI),0,0,'C');$this->Cell(9,6,"{$letraPromedioSI}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1II),0,0,'C');$this->Cell(11,6,"{$letraPromedioC1II}",0,0,'C');
					break;
				case 4:
					$promedioC1I=$sumatoriaC1I/(count($aMostrar));
					$promedioC2I=$sumatoriaC2I/(count($aMostrar));
					$promedioSI=$sumatoriaSI/(count($aMostrar));
					$promedioC1II=$sumatoriaC1II/(count($aMostrar));
					$promedioC2II=$sumatoriaC2II/(count($aMostrar));
					$promedioSII=$sumatoriaSII/(count($aMostrar));
					$promedioFinal=$sumatoriaFinal/(count($aMostrar));
		            //ceil($promedioC1I);
		            $boletin= new boletin();
        $letraPromedioC1I=$boletin->identificar_letra($promedioC1I);
        $letraPromedioC2I=$boletin->identificar_letra($promedioC2I);
        $letraPromedioSI=$boletin->identificar_letra($promedioSI);
        $letraPromedioC1II=$boletin->identificar_letra($promedioC1II);
        $letraPromedioC2II=$boletin->identificar_letra($promedioC2II);
        $letraPromedioSII=$boletin->identificar_letra($promedioSII);
        $letraPromedioFinal=$boletin->identificar_letra($promedioFinal);

        $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"Promedio",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1I),0,0,'C');$this->Cell(9,6,"{$letraPromedioC1I}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC2I),0,0,'C');$this->Cell(11,6,"{$letraPromedioC2I}",0,0,'C');$this->Cell(9,6,ceil($promedioSI),0,0,'C');$this->Cell(9,6,"{$letraPromedioSI}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1II),0,0,'C');$this->Cell(11,6,"{$letraPromedioC1II}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(7,6,ceil($promedioC2II),0,0,'C');$this->Cell(12,6,"{$letraPromedioC2II}",0,0,'C');$this->Cell(8,6,ceil($promedioSII),0,0,'C');$this->Cell(9,6,"{$letraPromedioSII}",0,0,'C');$this->Cell(8,6,ceil($promedioFinal),0,0,'C');$this->Cell(7,6,"{$letraPromedioFinal}",0,0,'C');
					break;
		}
		
	
		
		//   $this->Ln();    
        
        

	}

}

$pdf = new Rep_Factura('L','mm','Letter');


///////////////////////////7
//**********utiles***********//
$cod_estudiante=$_GET['id_estudiante'];
$user = $_GET['user'];
//$corte=$_GET['corte'];
//$cod_periodo=$_GET['id_periodo'];

//$corte=1;
$boletin= new boletin();
$cod_grado=$boletin->identificar_grado_del_estudiante($cod_estudiante);//var_dump($cod_grado);
$idEstudiante = $boletin->validarUsuarioEstudiante($cod_estudiante, $user);
$validarPago = $boletin->validarPago($cod_estudiante); //var_dump($validarPago);
//var_dump($idEstudiante);
if($idEstudiante == NULL || $validarPago == 2)
{
	echo 'No tiene los privilegios para acceder a esta pagina, o no se encuentra al dia en su pago';
}
else
{
if($cod_grado != NULL)
{	

$id_estudiantexgrado=$boletin->identificar_id_estudiantexgrado($cod_estudiante,$cod_grado);//var_dump($id_estudiantexgrado);
$nombreEstudiante=$boletin->identificar_estudiante($cod_estudiante);
$curso=$boletin->identificar_grado($cod_grado);
$materiasOrganizadas=$boletin->buscar_materias_organizadasxgrado($cod_grado);

//$cortesParaVisualizar=$_GET['corte'];////varible que se va a ir cambiando(1,2,3,4) segun los cortes que se quieran visualizar 
$cortesParaVisualizar=1;////varible que se va a ir cambiando(1,2,3,4) segun los cortes que se quieran visualizar 



	for ($j=0; $j < count($materiasOrganizadas) ; $j++) { 

          for ($l=0; $l <$cortesParaVisualizar; $l++) { 
          	# code...
          $parcialesCorte=$boletin->identificar_parciales($l);
                    
            for ($k=0; $k <count($parcialesCorte) ; $k++) { 
            	           

$acuPruFinLet[]=$boletin->listar_notas($id_estudiantexgrado,$materiasOrganizadas[$j]['id_m_o'],$parcialesCorte[$k]);

               
                 }//fin for k

                 $acu30Corte=$acuPruFinLet[0]['acumulado'];//+$acuPruFinLet[1]['acumulado'];
             $acu20Corte=$acuPruFinLet[0]['prueba'];//+$acuPruFinLet[1]['prueba'];
             $final=$acu30Corte+$acu20Corte;
             $letra=$boletin->identificar_letra($final);
             $acuPruFinLet="";
             $aMostrarCorte[]=array("acumulado"=>$acu30Corte,"prueba"=>$acu20Corte,"final"=>$final,"letra"=>$letra);
//var_dump($aMostrarCorte[1]);
                }//fin for l
             
        switch ($cortesParaVisualizar) {
        	case 1:
$aMostrar[]=array("materia"=>$materiasOrganizadas[$j]['descripcion'],"acumuladoC1"=>$aMostrarCorte[0]['acumulado'],"pruebaC1"=>$aMostrarCorte[0]['prueba'],"finalC1"=>$aMostrarCorte[0]['final'],"letraC1"=>$aMostrarCorte[0]['letra'],"acumuladoC2"=>"","pruebaC2"=>"","finalC2"=>"","letraC2"=>"","finalIsemestre"=>"","letraIsemestre"=>"","acumuladoC3"=>"","pruebaC3"=>"","finalC3"=>"","letraC3"=>"","acumuladoC4"=>"","pruebaC4"=>"","finalC4"=>"","letraC4"=>"","finalIIsemestre"=>"","letraIIsemestre"=>"","notalFinal"=>"","letraFinal"=>"");
$aMostrarCorte=""; 
        		break;
        	case 2:
        	//var_dump("entre sem_acqui");
        	$finalSemestreI=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
$aMostrar[]=array("materia"=>$materiasOrganizadas[$j]['descripcion'],"acumuladoC1"=>$aMostrarCorte[0]['acumulado'],"pruebaC1"=>$aMostrarCorte[0]['prueba'],"finalC1"=>$aMostrarCorte[0]['final'],"letraC1"=>$aMostrarCorte[0]['letra'],"acumuladoC2"=>$aMostrarCorte[1]['acumulado'],"pruebaC2"=>$aMostrarCorte[1]['prueba'],"finalC2"=>$aMostrarCorte[1]['final'],"letraC2"=>$aMostrarCorte[1]['letra'],"finalIsemestre"=>$finalSemestreI,"letraIsemestre"=>$letraFinalSemestreI,"acumuladoC3"=>"","pruebaC3"=>"","finalC3"=>"","letraC3"=>"","acumuladoC4"=>"","pruebaC4"=>"","finalC4"=>"","letraC4"=>"","finalIIsemestre"=>"","letraIIsemestre"=>"","notalFinal"=>"","letraFinal"=>"");
$aMostrarCorte="";	
        		break;
        	case 3:
        	$finalSemestreI=($aMostrarCorte[o]['final']+$aMostrarCorte[1]['final'])/2;
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
$aMostrar[]=array("materia"=>$materiasOrganizadas[$j]['descripcion'],"acumuladoC1"=>$aMostrarCorte[0]['acumulado'],"pruebaC1"=>$aMostrarCorte[0]['prueba'],"finalC1"=>$aMostrarCorte[0]['final'],"letraC1"=>$aMostrarCorte[0]['letra'],"acumuladoC2"=>$aMostrarCorte[1]['acumulado'],"pruebaC2"=>$aMostrarCorte[1]['prueba'],"finalC2"=>$aMostrarCorte[1]['final'],"letraC2"=>$aMostrarCorte[1]['letra'],"finalIsemestre"=>$finalSemestreI,"letraIsemestre"=>$letraFinalSemestreI,"acumuladoC3"=>$aMostrarCorte[2]['acumulado'],"pruebaC3"=>$aMostrarCorte[2]['prueba'],"finalC3"=>$aMostrarCorte[2]['final'],"letraC3"=>$aMostrarCorte[2]['letra'],"acumuladoC4"=>"","pruebaC4"=>"","finalC4"=>"","letraC4"=>"","finalIIsemestre"=>"","letraIIsemestre"=>"","notalFinal"=>"","letraFinal"=>"");
$aMostrarCorte="";	
        		
        		break;
        	case 4:
        		$finalSemestreI=($aMostrarCorte[o]['final']+$aMostrarCorte[1]['final'])/2;
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
        	$finalSemestreII=($aMostrarCorte[2]['final']+$aMostrarCorte[3]['final'])/2;
        	$letraFinalSemestreII =$boletin->identificar_letra($finalSemestreII);
        	$notaFinalAno=($finalSemestreI+$finalSemestreII)/2;
        	$letraFinalAno=$boletin->identificar_letra($notaFinalAno);
$aMostrar[]=array("materia"=>$materiasOrganizadas[$j]['descripcion'],"acumuladoC1"=>$aMostrarCorte[0]['acumulado'],"pruebaC1"=>$aMostrarCorte[0]['prueba'],"finalC1"=>$aMostrarCorte[0]['final'],"letraC1"=>$aMostrarCorte[0]['letra'],"acumuladoC2"=>$aMostrarCorte[1]['acumulado'],"pruebaC2"=>$aMostrarCorte[1]['prueba'],"finalC2"=>$aMostrarCorte[1]['final'],"letraC2"=>$aMostrarCorte[1]['letra'],"finalIsemestre"=>$finalSemestreI,"letraIsemestre"=>$letraFinalSemestreI,"acumuladoC3"=>$aMostrarCorte[2]['acumulado'],"pruebaC3"=>$aMostrarCorte[2]['prueba'],"finalC3"=>$aMostrarCorte[2]['final'],"letraC3"=>$aMostrarCorte[2]['letra'],"acumuladoC4"=>$aMostrarCorte[3]['acumulado'],"pruebaC4"=>$aMostrarCorte[3]['prueba'],"finalC4"=>$aMostrarCorte[3]['final'],"letraC4"=>$aMostrarCorte[3]['letra'],"finalIIsemestre"=>$finalSemestreII,"letraIIsemestre"=>$letraFinalSemestreII,"notaFinal"=>$notaFinalAno,"letraFinal"=>$letraFinalAno);
$aMostrarCorte="";	
        		break;
        	
        }

             
	}//fin for interno j
	
	$pdf->Render($nombreEstudiante,$aMostrar,$curso,$cortesParaVisualizar);
$pdf->AddPage();
$aMostrar="";




$pdf->Output();	

}
else
{
	echo 'El estudiante no se encuentra matriculado';
}
}



/*$pdf = new Rep_Factura('L','mm','Letter');
$pdf->Render(13097511);*/



?>
