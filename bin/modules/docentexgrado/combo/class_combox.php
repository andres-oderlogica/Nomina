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
                     from docente
                     where cod_perfil = 2";
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

function getMateriaxgrado()
    {
      
      $sql = "SELECT 
              `materiaxgrado`.`id_mxg`,
              CONCAT(`grado`.`descripcion`, ' ', `grado`.`letra`,' --- ',`materia`.`descripcion`) AS `curso`,
              `materia`.`descripcion`,
              `grado`.`id_grado`
            FROM
              `materiaxgrado`
              INNER JOIN `materia` ON (`materiaxgrado`.`cod_materia` = `materia`.`id_materia`)
              INNER JOIN `grado` ON (`materiaxgrado`.`cod_grado` = `grado`.`id_grado`)";
      $rs = $this->db->dosql($sql,array());
    //var_dump($rs);
      while (!$rs->EOF) 
               {
               $datos[] = array(
                'id_mxg' => $rs->fields['id_mxg'],
                'curso' => $rs->fields['curso'],
                'grado' => $rs->fields['id_grado']);                              
      
                $rs->MoveNext();      
                }              
              
           return $datos;

}  
	
	}

	?>