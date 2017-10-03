<?php
 include_once Config::$home_lib.'adodb5'.Config::$ds.'adodb.inc.php'; 

 class base 
 {
 		private $server; 
		private $user;         
		private $password;					
		private $database;
		private $sql_instruction;
		protected $adodb;
		public $rs; 
		
		function __construct()
		{
		   $this->adodb = ADONewConnection('mysqli'); 
		}
		
		public function getADOdb()
		{
		 return $this->adodb;
		}
		
		function debug_on($value)
		{
		 $this->adodb->debug = $value;
		}
		
 		function setup($server, $user, $pass, $db)
		{
		    $this->adodb->connect($server, $user, $pass, $db);
		  
		} 
		function dosql($sql_instruction, $params)   //previene sql injection
{	
  $this->rs = $this->adodb->Execute($sql_instruction, $params);
  return($this->rs);	
}
function dosql1($sql_instruction)
		{		
		   $this->rs = $this->adodb->Execute($sql_instruction);
		   return($this->rs);		
		}
		
		function get_data($sql, $field='')
		{		 
	     $rs = $this->dosql($sql);
	     // print_r($rs);
	     if ($field == '')
	       { 
		    reset($rs->fields);
		    $res = current($rs->fields);
		   }
     	 else
	      $res = $rs->fields[$field];
	     // die("res - $res");		 
	     return($res); 
		}
		
		function Insert($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record, 'INSERT', $where);
		}

		function Update($table, $record, $where=false)
		{
		 $this->adodb->AutoExecute($table, $record,'UPDATE', $where);
		}	
		
		function InsUpd($table, $record, $key, $autoquote=false)
		{
		  $this->adodb->Replace($table, $record, $key, $autoquote);
		}
		
		function ErrorNo()
		{
		 return($this->adodb->ErrorNo());
		}
		
		function ErrorMsg()
		{
		 return($this->adodb->ErrorMsg());
		}
		
		function record_style($style)
		{if ($style=='fields') $this->adodb->SetFetchMode(ADODB_FETCH_ASSOC);
		 if ($style=='numbers') $this->adodb->SetFetchMode(ADODB_FETCH_NUM);
		 if ($style=='both') $this->adodb->SetFetchMode(ADODB_FETCH_BOTH);
	     if ($style=='default') $this->adodb->SetFetchMode(ADODB_FETCH_DEFAULT);
		}
}
?>
