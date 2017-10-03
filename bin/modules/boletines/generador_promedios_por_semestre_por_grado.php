<?php
include_once '../utiles/pdf_helper.php';
include_once '../utiles/data_reports.php';
include_once '../utiles/code128.php';
include '../../../core.php';
include_once 'clases/boletin.php';


class Rep_Factura extends PDFReport  
{
	
	private function Render2($porPromedio,$materiasOrganizadas,$estudiante,$aMostrar,$curso,$corte,$director)
	{ //var_dump($porPromedio);

		$this->AddPage();
$this->Image("fondo_90.png", 0, 0, 280);
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
		$this->Cell(30,5,"",0,0,'L');$this->Cell(5,5,"{$curso}",0,0,'L');$this->Cell(30,5,"",0,0,'L');$this->Cell(5,5,"{$director}",0,0,'L');//primer cero indica que no lleve borde
		$this->Ln();
		$this->EscC('');
		

		$this->SetFont('Arial','',5);

		
        $this->Cell(13,5,"",0,0,'C');$this->Cell(33,5,"Nombres y Apellidos",1,0,'L');

		for ($j	=0; $j	 < count($materiasOrganizadas); $j	++) { 

$this->Cell(13.5,5,"{$materiasOrganizadas[$j]['descripcion']}",1,0,'L');
			


		}
		$this->Cell(14,5,"Promedio",1,0,'L');
			$this->Ln();

			for ($J	=0; $J	 < count($porPromedio); $J++) {
				$this->SetFont('Arial','',5);

	//if($J==2){$this->AddPage();$this->Image("fondo_promedio.png", 0, 0, 280);}
				$valor=$porPromedio[$J]['ubicacion'];
$this->Cell(5,5,"",0,0,'C');$this->Cell(41,6,"{$estudiante[$valor]['nombre']}",1,0,'L');

$this->SetFont('Arial','',12);
		for ($i	=0; $i	 < count($aMostrar[$J]); $i	++) { 

					$this->Cell(13.5,6,"{$aMostrar[$valor][$i]}",1,0,'C');

		$sumatoriaC1I+=$aMostrar[$valor][$i];
			
			




		}//fin for i

		$promedioC1I=$sumatoriaC1I/(count($aMostrar[$valor]));
		$decimales=number_format($promedioC1I, 2, '.', '');
		$this->Cell(13.5,6,"{$decimales}",1,0,'C');
		$sumatoriaC1I=0;


$this->Ln();

	}//fin for J
	}


 	public function Render($materiasOrganizadas,$estudiante,$aMostrar,$curso,$corte,$director)
	{
		$sumatoria=0;
		
		$this->Image("fondo_promedio.png", 0, 0, 280);
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
		$this->Cell(30,5,"",0,0,'L');$this->Cell(5,5,"{$curso}",0,0,'L');$this->Cell(30,5,"",0,0,'L');$this->Cell(5,5,"{$director}",0,0,'L');//primer cero indica que no lleve borde
		$this->Ln();
		$this->EscC('');
		

		$this->SetFont('Arial','',5);

		
        $this->Cell(13,5,"",0,0,'C');$this->Cell(33,5,"Nombres y Apellidos",1,0,'L');

		for ($j	=0; $j	 < count($materiasOrganizadas); $j	++) { 

$this->Cell(13.5,5,"{$materiasOrganizadas[$j]['descripcion']}",1,0,'L');
			


		}
		$this->Cell(14,5,"Promedio",1,0,'L');
			$this->Ln();

		$cantidad=count($aMostrar);

for ($J	=0; $J	 < count($estudiante); $J++) {
$this->SetFont('Arial','',5);
	//if($J==2){$this->AddPage();$this->Image("fondo_promedio.png", 0, 0, 280);}
$this->Cell(5,5,"",0,0,'C');$this->Cell(41,6,"{$estudiante[$J]['nombre']}",1,0,'L');

$this->SetFont('Arial','',12);
		for ($i	=0; $i	 < count($aMostrar[$J]); $i	++) { 

					$this->Cell(13.5,6,"{$aMostrar[$J][$i]}",1,0,'C');

		$sumatoriaC1I+=$aMostrar[$J][$i];
			
			




		}//fin for i

		$promedioC1I=$sumatoriaC1I/(count($aMostrar[$J]));
		$decimales=number_format($promedioC1I, 0, '.', '');
		$this->Cell(13.5,6,"{$decimales}",1,0,'C');
		$sumatoriaC1I=0;

if($decimales>=90)
{
$existen=true;
$porPromedio[]=array("promedio"=>$promedioC1I,"ubicacion"=>$J);

}


$this->Ln();

	}//fin for J
//var_dump($porPromedio);
//rsort($porPromedio);

if($existen){
	rsort($porPromedio);
	$this->Render2($porPromedio,$materiasOrganizadas,$estudiante,$aMostrar,$curso,$corte,$director);
}else
{
    $this->Ln();
    $this->EscC('');
    $this->SetFont('Arial','',12);
	$this->Cell(100,5,"",0,0,'C');$this->Cell(13.5,6,"Ningun estudiante tiene un promedio mayor a 90",0,0,'C');
$this->SetFont('Arial','',5);
}

		
					
		          
       // $this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"Promedio",0,0,'L');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,ceil($promedioC1I),0,0,'C');$this->Cell(9,6,"{$letraPromedioC1I}",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(11,6,"",0,0,'C');$this->Cell(9,6,"",0,0,'C');$this->Cell(9,6,"",0,0,'C');
					

} //fin metodo render


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

$estudiantesGrado=$boletin->buscar_estudiantesxgrado_para_promedio($cod_grado);
$director=$boletin->identificar_director_grado($cod_grado);
//var_dump($materiasOrganizadas,$estudiantesGrado);
if($_GET['semestre']==3)
{

$cortesParaVisualizar=4;

}
else
{
$cortesParaVisualizar=$boletin->identificar_cantidad_de_cortes($_GET['semestre']);
}

$materiasOrganizadas=$boletin->buscar_abre_materias_organizadasxgrado($cod_grado,$cortesParaVisualizar);


//var_dump($materiasOrganizadas);
for ($i=0; $i < count($estudiantesGrado) ; $i++) { 

	for ($j=0; $j < count($materiasOrganizadas) ; $j++) { 


		for ($l=0; $l <$cortesParaVisualizar; $l++) { 
          	# code...
          $parcialesCorte=$boletin->identificar_parciales($l);
                    
            for ($k=0; $k <count($parcialesCorte) ; $k++) { 
            	           

$acuPruFinLet[]=$boletin->listar_notas($estudiantesGrado[$i]['id_estudiante'],$materiasOrganizadas[$j]['id_m_o'],$parcialesCorte[$k]);

               
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
        	
        	case 2:
        	//var_dump("entre sem_acqui");
        	$finalSemestreIsin=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
        	$finalSemestreI=number_format($finalSemestreIsin, 0, '.', '');
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
$notaFinalMateria[]=$finalSemestreI;
$aMostrarCorte=""; 

        		break;
        	
        	case 4:

        	if($_GET['semestre']==3)
        	{
               
               $finalSemestreIsin=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
               $finalSemestreI=number_format($finalSemestreIsin, 0, '.', '');
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
        	$finalSemestreII=($aMostrarCorte[2]['final']+$aMostrarCorte[3]['final'])/2;
        	$letraFinalSemestreII =$boletin->identificar_letra($finalSemestreII);
        	$notaFinalAno=($finalSemestreI+$finalSemestreII)/2;
        	$letraFinalAno=$boletin->identificar_letra($notaFinalAno);
            $notaFinalMateria[]=$notaFinalAno;
            $aMostrarCorte=""; 
        	}
        	else
        	{
        		$finalSemestreIsin=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
        		$finalSemestreI=number_format($finalSemestreIsin, 0, '.', '');
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
        	$finalSemestreII=($aMostrarCorte[2]['final']+$aMostrarCorte[3]['final'])/2;
        	$letraFinalSemestreII =$boletin->identificar_letra($finalSemestreII);
        	$notaFinalAno=($finalSemestreI+$finalSemestreII)/2;
        	$letraFinalAno=$boletin->identificar_letra($notaFinalAno);
$notaFinalMateria[]=$finalSemestreII;
$aMostrarCorte=""; 

        	}

        		
        		break;

            
                   		
        	
        } 
          
       
                

        		

             
	}//fin for interno j


$aMostrar[]=$notaFinalMateria;
$notaFinalMateria="";
	

	
	
//$pdf->AddPage();


}//fin for externo
//var_dump($aMostrar);
//var_dump(count($estudiantesGrado),count($aMostrar[0]));
$pdf->Render($materiasOrganizadas,$estudiantesGrado,$aMostrar,$curso,$cortesParaVisualizar,$director);
$pdf->Output();	





/*$pdf = new Rep_Factura('L','mm','Letter');
$pdf->Render(13097511);*/



?>
