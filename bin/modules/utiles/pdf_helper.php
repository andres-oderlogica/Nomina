<?php
 /***********************************************************
 * Generador de PDF
 *
 * @author     Jimmy Andrés campo Bravo  <info@oderlogica.com>
 * @copyright  1996-2015 Oderlogica - Todos los derechos reservados - http://www.oderlogica.com
 * @license    Este código y sus derivados son propiedad de Oderlogica
 * @version    1.0
 ************************************************************/

include_once '../../../lib/fpdf/fpdf.php';
require'code128.php';


class PDFCol
{
	public $width;
	public $height = 0;
	public $align = 'L';  //C, R
	public $border = 0;  // 0: sin borde, 1: marco, L: izquierda, T: superior, R: derecha,B: inferior
	public $fill = false;
	public $text;

	function __construct($txt, $w, $h=0, $a = 'P', $b = 0, $fill = false)
	{
        $this->width = $w;
        $this->height = $h;
        $this->align = $a;
        $this->border = $b;
        $this->fill = $fill;
        $this->text = $txt;
	}
}

class PDFRow
{
   private $cols= array();
   private $pdf;

   public function __construct($pdf)
   {
   		$this->pdf = $pdf;
   }

	public function Add($w=0, $h=0, $a = 'L', $b = 0, $fill = false)
	{
		$this->cols[] = new PDFCol($text, $w, $h, $a, $b, $fill);
	}

	public function Render($data)
	{	reset($data);
		foreach ($this->cols as $col) {
			$this->pdf->Cell($col->width, $col->height, utf8_decode(current($data)), $col->border, 0, $col->align, $col->fill);	
			next($data);
		}
	}
}


/**
* 
*/
class PDFReport extends PDF_Code128
{
	private $grids = array();
	
	function __construct($orienta = 'P', $medida = 'mm', $tam='Letter')
	{
		parent::__construct($orienta, $medida, $tam);
		$this->AddPage();  // nueva página
	}

	function newGrid()
	{
		return $this->grids[] = new PDFRow($this);		
	}

	function addCell($w=0, $h=0, $b = 0, $a = 'L', $fill = false)
	{
		end($this->grids)->Add($w, $h, $a, $b, $fill);
	}

	public function renderRow($data, $idx=0)
	{   
		// var_dump($this->grids[0]);

		if (isset($this->grids[$idx]))
			$this->grids[$idx]->render($data);
	}

	public function EscC($txt, $alto = 3, $borde=0)
	{		
		$this->Cell(0,$alto,utf8_decode($txt),$borde,1,'C'); 		
	}

	public function Esc($txt, $w=0, $h=4, $b = 0, $a = 'L', $fill = false, $next=0)
	{				
		$this->Cell($w, $h, utf8_decode($txt), $b, $next, $a, $fill);		
	}





}



?>