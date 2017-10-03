<?php
 class Result
 {
 	public $Data;
 	public $Status=0;
 	public $Extra;
 	
 	public function __construct($data='', $status=0)
 	{
 		$this->Data = $data;
 		$this->Status = $status;
 	}
 	
 	public function SetData($data)
 	{
 		$this->Data = $data;
 	}
 	
	private function Headers()
		{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	  header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT"); 
		header("Cache-Control: no-cache, must-revalidate"); 
		header("Pragma: no-cache");
		header("Content-type: application/json");
		}
	
 	public function getJSON()
 	{
 		$this->Headers();
 		return (json_encode($this));
 	}
	
	public function getError()
		{
			$this->Headers();
 		  echo (json_encode($this));
			die(); //reporta y finaliza
		}
 }
// echo $r->getJSON();
?>