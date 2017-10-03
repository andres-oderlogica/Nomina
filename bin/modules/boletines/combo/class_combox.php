<?php
include '../../../../core.php';
class combo
{
	

	function __construct()
	{      
      $this->db = App::$base; 
	}

	function getGrado()
	{	  
       $sql="SELECT id_grado, CONCAT(descripcion,'-',letra) as curso 
  			from grado 
  			 ";
		$rs = $this->db->dosql($sql, array()); 
        while (!$rs->EOF) 
           {
	         $data[] = array(
	         	'id_grado' => $rs->fields['id_grado'],
	         	'curso' => $rs->fields['curso']
	         	);	                             
	
	          $rs->MoveNext();	    
            }              
          
       return $data;
	}

  function getPeriodo()
  {   
       $sql="SELECT id_periodo, periodo.descripcion as periodo ,semestre.descripcion as semestre
        from periodo,semestre
        where cod_semestre=id_semestre";
    $rs = $this->db->dosql($sql, array()); 
        while (!$rs->EOF) 
           {
           $data[] = array(
            'id_periodo' => $rs->fields['id_periodo'],
            'descripcion' => $rs->fields['periodo']."/".$rs->fields['semestre']
            );                               
  
            $rs->MoveNext();      
            }              
          
       return $data;
  }

	function getJornada()
    {
    	
      $sql = "SELECT id_jornada,
                     descripcion
                     from jornada";
      $rs = $this->db->dosql($sql,array());
    //var_dump($rs);
      while (!$rs->EOF) 
               {
               $datos[] = array(
                'id_jornada' => $rs->fields['id_jornada'],
                'descripcion' => $rs->fields['descripcion']);                              
      
                $rs->MoveNext();      
                }              
              
           return $datos;

}   

function getDocente()
    {
      
      $sql = "SELECT id_docente,
                     nombre_completo
                     from docente";
      $rs = $this->db->dosql($sql,array());
    //var_dump($rs);
      while (!$rs->EOF) 
               {
               $datos[] = array(
                'id_docente' => $rs->fields['id_docente'],
                'nombre_completo' => $rs->fields['nombre_completo']);                              
      
                $rs->MoveNext();      
                }              
              
           return $datos;

}  
	
	}

	?>