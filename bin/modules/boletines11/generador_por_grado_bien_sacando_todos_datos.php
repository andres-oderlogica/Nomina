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
				$this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"{$aMostrar[$i]['materia']}",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC2']}",0,0,'C');
				$this->Ln();
			}
			else
			{
				$this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"{$aMostrar[$i]['materia']}",0,0,'L');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC2']}",0,0,'C');
			$this->Ln();
			

			}

			switch ($corte) {
				case 'value':
					# code...
					break;
				
				default:
					# code...
					break;
			}
			$sumatoria+=$aMostrar[$i]['finalC1'];




		}
		$promedio=$sumatoria/(count($aMostrar));
		ceil($promedio);
	
		
		//   $this->Ln();    
        
        $boletin= new boletin();
        $letra=$boletin->identificar_letra($promedio);
        $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedio),0,0,'C');$this->Cell(9,6,"{$letra}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC2']}",0,0,'C');

	}

}

$pdf = new Rep_Factura('L','mm','Letter');


///////////////////////////7
//**********utiles***********//
$cod_grado=$_GET['id_grado'];
//$corte=$_GET['corte'];
//$cod_periodo=$_GET['id_periodo'];

//$corte=1;
$boletin= new boletin();

$curso=$boletin->identificar_grado($cod_grado);
$materiasOrganizadas=$boletin->buscar_materias_organizadasxgrado($cod_grado);
$estudiantesGrado=$boletin->buscar_estudiantesxgrado($cod_grado);
//var_dump($materiasOrganizadas,$estudiantesGrado);
$cortesParaVisualizar=$_GET['corte'];////varible que se va a ir cambiando(1,2,3,4) segun los cortes que se quieran visualizar 

for ($i=0; $i < count($estudiantesGrado) ; $i++) { 

	for ($j=0; $j < count($materiasOrganizadas) ; $j++) { 

          for ($l=0; $l <$cortesParaVisualizar; $l++) { 
          	# code...
          $parcialesCorte=$boletin->identificar_parciales($l);
                    
            for ($k=0; $k <count($parcialesCorte) ; $k++) { 
            	           

$acuPruFinLet[]=$boletin->listar_notas($estudiantesGrado[$i]['id_estudiante'],$materiasOrganizadas[$j]['id_m_o'],$parcialesCorte[$k]);

               
                 }//fin for k

                 $acu30Corte=$acuPruFinLet[0]['acumulado']+$acuPruFinLet[1]['acumulado'];
             $acu20Corte=$acuPruFinLet[0]['prueba']+$acuPruFinLet[1]['prueba'];
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
$aMostrar[]=array("materia"=>$materiasOrganizadas[$j]['descripcion'],"acumuladoC1"=>$aMostrarCorte[0]['acumulado'],"pruebaC1"=>$aMostrarCorte[0]['prueba'],"finalC1"=>$aMostrarCorte[0]['final'],"letraC1"=>$aMostrarCorte[0]['letra'],"acumuladoC2"=>$aMostrarCorte[1]['acumulado'],"pruebaC2"=>$aMostrarCorte[1]['prueba'],"finalC2"=>$aMostrarCorte[1]['final'],"letraC2"=>$aMostrarCorte[1]['letra'],"finalIsemestre"=>$finalSemestreI,"letraIsemestre"=>$letraFinalSemestreI,"acumuladoC3"=>$aMostrarCorte[2]['acumulado'],"pruebaC3"=>$aMostrarCorte[2]['prueba'],"finalC3"=>$aMostrarCorte[2]['final'],"letraC3"=>$aMostrarCorte[2]['letra'],"acumuladoC4"=>$aMostrarCorte[3]['acumulado'],"pruebaC4"=>$aMostrarCorte[3]['prueba'],"finalC4"=>$aMostrarCorte[3]['final'],"letraC4"=>$aMostrarCorte[3]['letra'],"finalIIsemestre"=>$finalSemestreII,"letraIIsemestre"=>$letraFinalSemestreII,"notalFinal"=>$notaFinalAno,"letraFinal"=>$letraFinalAno);
$aMostrarCorte="";	
        		break;
        	
        }

             
	}//fin for interno j
	
	$pdf->Render($estudiantesGrado[$i]['nombre'],$aMostrar,$curso,$corte);
$pdf->AddPage();
$aMostrar="";

}//fin for externo


$pdf->Output();	





/*$pdf = new Rep_Factura('L','mm','Letter');
$pdf->Render(13097511);*/



?>
