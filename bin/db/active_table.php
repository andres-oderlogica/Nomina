<?php
 
 include_once Config::$home_lib.'adodb5'.Config::$ds.'adodb-active-record.inc.php'; 
 
 ADOdb_Active_Record::SetDatabaseAdapter(App::$base->getADOdb());
 
 class atable extends ADODB_Active_Record 
 {
 	function Save()
 	{
 		// Agregar el generador a la llave primaria en inserci�n
 		// el generador debe llamarse GEN_(Campo PK)
 		if ($this->$App->base->driver == 'firebird')
			{	
 		$ids = $this->DB()->MetaPrimaryKeys($this->_table);  // PK
 		$id = (count($ids) > 0)?$ids[0]:'';
 		
 		if ((!$this->_saved) && ($id != ''))
 		 { $id = strtolower($id);
 		   $gen = 'GEN_'.strtoupper($id); 		   
 		   $this->$id = $this->DB()->GenID($gen);
 		 }
			}
 		parent::Save(); 
 	}
 	
  public static function Make($name) 
  {
     return new atable($name);
  }
  	
 }
 
 
 
?>