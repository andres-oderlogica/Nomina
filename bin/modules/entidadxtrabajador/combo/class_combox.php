<?php
include '../../../../core.php';
class combo
{


	function __construct()
	{
      $this->db = App::$base;
	}

	function getTrabajador()
	{
       $sql="SELECT id_trabajador, CONCAT(primer_nombre,' ',segundo_nombre,' ',primer_apellido,' ',segundo_apellido) as nombres
  			from trabajador
  			 ";
		$rs = $this->db->dosql($sql, array());
        while (!$rs->EOF)
           {
	         $data[] = array(
	         	'id_trabajador' => $rs->fields['id_trabajador'],
	         	'nombres' => $rs->fields['nombres']
	         	);

	          $rs->MoveNext();
            }

       return $data;
	}

	function getEntidad()
    {

      $sql = "SELECT id_entidad,
                     nombre_entidad
                     from entidad";
      $rs = $this->db->dosql($sql,array());
    //var_dump($rs);
      while (!$rs->EOF)
               {
               $datos[] = array(
                'id_entidad' => $rs->fields['id_entidad'],
                'nombre_entidad' => $rs->fields['nombre_entidad']);

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
