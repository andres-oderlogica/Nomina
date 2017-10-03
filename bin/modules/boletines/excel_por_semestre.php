<?php
include '../../../core.php';
include_once 'clases/boletin.php';
require '../../../lib/PHPExcel.php';


//////////////////////////7
//**********utiles***********//
$cod_grado=$_GET['id_grado'];
//$corte=$_GET['corte'];
//$cod_periodo=$_GET['id_periodo'];

//$corte=1;

$columnas[0]="B";
$columnas[1]="C";
$columnas[2]="D";
$columnas[3]="E";
$columnas[4]="F";
$columnas[5]="G";
$columnas[6]="H";
$columnas[7]="I";
$columnas[8]="J";
$columnas[9]="K";
$columnas[10]="L";
$columnas[11]="M";
$columnas[12]="N";
$columnas[13]="O";
$columnas[14]="P";
$columnas[15]="Q";
$columnas[16]="R";
$columnas[17]="S";
$columnas[18]="T";
$columnas[19]="U";

$boletin= new boletin();

$curso=$boletin->identificar_grado($cod_grado);

$director=$boletin->identificar_director_grado($cod_grado);
//buscar_materias_organizadasxgrado($cod_grado);
$ultimo=count($materiasOrganizadas);
$materiasOrganizadasParaRender[$ultimo]=array("id_m_o"=>"","descripcion"=>"Promedio");
//var_dump($materiasOrganizadas);
$estudiantesGrado=$boletin->buscar_estudiantesxgrado_para_promedio($cod_grado);

if($_GET['semestre']==3)
{

$cortesParaVisualizar=4;
}
else
{
$cortesParaVisualizar=$boletin->identificar_cantidad_de_cortes($_GET['semestre']);

}
$materiasOrganizadas=$boletin->buscar_abre_materias_organizadasxgrado($cod_grado,$cortesParaVisualizar);
$materiasOrganizadasParaRender=$materiasOrganizadas;

//var_dump($_GET['semestre']);
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
        	$finalSemestreI=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
        	$letraFinalSemestreI =$boletin->identificar_letra($finalSemestreI);
$notaFinalMateria[]=$finalSemestreI;
$aMostrarCorte=""; 

        		break;
        	
        	case 4:

        	if($_GET['semestre']==3)
        	{
               
               $finalSemestreI=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
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
        		$finalSemestreI=($aMostrarCorte[0]['final']+$aMostrarCorte[1]['final'])/2;
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


//Objeto de PHPExcel
	$objPHPExcel  = new PHPExcel();
	
	//Propiedades de Documento
	$objPHPExcel->getProperties()->setCreator("Sofware Notas")->setDescription("Reporte de Promedios");
	
	//Establecemos la pestaña activa y nombre a la pestaña
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setTitle("Promedios Generales");
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(43);
	//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);

$objPHPExcel->getActiveSheet()->setCellValue('A1', utf8_encode($curso." / ".$director));

///render materias///
	$fila=3;
	$filaEstudiantes=4;
	$filaEstaticaEstudiantes=4;
for ($z=0; $z <count($materiasOrganizadasParaRender) ; $z++)
{ 
$columna=$columnas[$z].$fila;
$objPHPExcel->getActiveSheet()->setCellValue($columna, $materiasOrganizadasParaRender[$z]['descripcion']);
}

//fin render materias /////

///render estudiantes con notas///

for ($J	=0; $J	 < count($estudiantesGrado); $J++) {

//$this->Cell(5,5,"",0,0,'C');$this->Cell(41,6,"{$estudiante[$J]['nombre']}",1,0,'L');
$objPHPExcel->getActiveSheet()->setCellValue('A'.$filaEstudiantes, utf8_encode($estudiantesGrado[$J]['nombre']));

		for ($i	=0; $i	 < count($aMostrar[$J]); $i	++) { 

					//$this->Cell(13.5,6,"{$aMostrar[$J][$i]}",1,0,'C');
			$columnaNotas=$columnas[$i].$filaEstudiantes;
$objPHPExcel->getActiveSheet()->setCellValue($columnaNotas, $aMostrar[$J][$i]);
		$sumatoriaC1I+=$aMostrar[$J][$i];
			
			



		}//fin for i

	

		$promedioC1I=$sumatoriaC1I/(count($aMostrar[$J]));
		$decimales=number_format($promedioC1I, 2, '.', '');
		//$this->Cell(13.5,6,"{$decimales}",1,0,'C');
		$columnaNotas=$columnas[$i].$filaEstudiantes;
		$objPHPExcel->getActiveSheet()->setCellValue($columnaNotas, $decimales);
		$sumatoriaC1I=0;

if($decimales>=90)
{
$existen=true;
$porPromedio[]=array("promedio"=>$promedioC1I,"ubicacion"=>$J);
//var_dump(count($porPromedio));
}


$filaEstudiantes++;

	}//fin for J
	
/////fin render estudiantes con notas
if($existen)
{

	$fila=3;
	$filaEstudiantes=4;
	$filaEstaticaEstudiantes=4;

///render estudianres con promedio > 90///
    $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(1);
	$objPHPExcel->getActiveSheet()->setTitle("Pro mayores a 90");
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(43);
	//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ID');
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);

$objPHPExcel->getActiveSheet()->setCellValue('A1', utf8_encode($curso." / ".$director));

///render materias///
	$fila=3;
	$filaEstudiantes=4;
	$filaEstaticaEstudiantes=4;
for ($z=0; $z <count($materiasOrganizadasParaRender) ; $z++)
{ 
$columna=$columnas[$z].$fila;
$objPHPExcel->getActiveSheet()->setCellValue($columna, $materiasOrganizadasParaRender[$z]['descripcion']);
}


for ($J	=0; $J	 < count($porPromedio); $J++) {
				//var_dump($porPromedio[$J]);

	//if($J==2){$this->AddPage();$this->Image("fondo_promedio.png", 0, 0, 280);}
				$valor=$porPromedio[$J]['ubicacion'];

$objPHPExcel->getActiveSheet()->setCellValue('A'.$filaEstudiantes, utf8_encode($estudiantesGrado[$valor]['nombre']));


		for ($i	=0; $i	 < count($aMostrar[$J]); $i	++) { 

					//$this->Cell(13.5,6,"{$aMostrar[$valor][$i]}",1,0,'C');
	$columnaNotas=$columnas[$i].$filaEstudiantes;
$objPHPExcel->getActiveSheet()->setCellValue($columnaNotas, $aMostrar[$valor][$i]);
		//$sumatoriaC1I+=$aMostrar[$J][$i];

		$sumatoriaC1I+=$aMostrar[$valor][$i];
			
			




		}//fin for i

		$promedioC1I=$sumatoriaC1I/(count($aMostrar[$valor]));
		$decimales=number_format($promedioC1I, 2, '.', '');
		$columnaNotas=$columnas[$i].$filaEstudiantes;
		$objPHPExcel->getActiveSheet()->setCellValue($columnaNotas, $decimales);
		$sumatoriaC1I=0;




$filaEstudiantes++;

	}//fin for J




///fin render estudiantes con promedio >90

}

$objPHPExcel->setActiveSheetIndex(0);
$nombreArchivo=$curso.".xlsx";

$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	
	
	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="'.$nombreArchivo.'"');
	header('Cache-Control: max-age=0');
	
	$writer->save('php://output'); 



?>
