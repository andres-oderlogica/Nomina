<?php
include_once '../utiles/pdf_helper.php';
include_once '../utiles/data_reports.php';
include_once '../utiles/code128.php';
include '../../../core.php';
include_once 'clases/boletin.php';


class Rep_Factura extends PDFReport  
{
	
	
 	public function Render($estudiante,$director,$curso)
	{
		
		//var_dump($director);		
		$this->Image("portada.png", 0, 0, 280);
		$this->SetFont('Arial','',8);
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
		$this->EscC('');
		$this->Cell(211,5,"",0,0,'L');$this->Cell(5,5,"{$estudiante}",0,0,'L');//primer cero indica que no lleve borde
		$this->Ln();
		$this->Cell(211,5,"",0,0,'L');$this->Cell(5,5,"{$director}",0,0,'L');//primer cero indica que no lleve borde
		$this->Ln();
		$this->Ln();
		$this->Cell(211,5,"",0,0,'L');$this->Cell(5,5,"{$curso}",0,0,'L');
		$this->EscC('');
		$this->EscC('');

		

		
		$this->Ln();
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		$this->EscC('');
		
		$this->EscC('');
		$this->EscC('');
			
		
		
			
			//$this->Cell(5,5,"",0,0,'C');$this->Cell(45,6,"{$aMostrar[$i]['materia']}",0,0,'L');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['pruebaC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['finalC1']}",0,0,'C');$this->Cell(9,6,"{$aMostrar[$i]['letraC1']}",0,0,'C');$this->Cell(11,6,"{$aMostrar[$i]['acumuladoC2']}",0,0,'C');
			
			$this->Ln();
			

		
		
		
		       
        

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
$estudiantesGrado=$boletin->buscar_estudiantesxgrado($cod_grado);
$director=$boletin->identificar_director_grado($cod_grado);
//var_dump($director);
for ($i=0; $i < count($estudiantesGrado) ; $i++) { 

	
	
	$pdf->Render($estudiantesGrado[$i]['nombre'],$director,$curso);
$pdf->AddPage();


}//fin for externo


$pdf->Output();	





/*$pdf = new Rep_Factura('L','mm','Letter');
$pdf->Render(13097511);*/



?>
