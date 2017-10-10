<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Gradoxmateria extends ADOdb_Active_Record{}
 class PlantillaNotas extends ADOdb_Active_Record{}
class regGradoxmateria
{

public function reg_gradoxmateria($materia,$id_grado)
    {
        $reg              = new Gradoxmateria('materiaxgrado');
        $reg->cod_materia      = $materia;
        $reg->cod_grado = $id_grado;
        $reg->Save();
        ;
    }

public function cambiarEstado($estado,$id)
  {
        $db = App::$base;
        $sql = "UPDATE `colegio`.`estudiante`
                SET id_estado = ?
                WHERE `id_estudiante`= ?";
    $rs = $db->dosql($sql, array($estado,$id));
      // var_dump($rs);
  }


public function listmateriaxgrado($id)
{
	$con = App::$base;
    $sql = "SELECT 
  `materiaxgrado`.`id_mxg`,
  CONCAT(`grado`.`descripcion`, ' ', `grado`.`letra`) AS `curso`,
  `materia`.`descripcion`,
  `grado`.`id_grado`,
   \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as borrar
FROM
  `materiaxgrado`
  INNER JOIN `materia` ON (`materiaxgrado`.`cod_materia` = `materia`.`id_materia`)
  INNER JOIN `grado` ON (`materiaxgrado`.`cod_grado` = `grado`.`id_grado`)
  where id_grado = ?
            order by descripcion ASC
            ";

		$rs = $con->dosql($sql, array($id));
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Grado</th>
                        <th id="yw9_c2">Materia</th>
                         <th id="yw9_c3">Eliminar</th>
                        
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr>  
                            <td>                            
                                '.utf8_encode($rs->fields['id_mxg']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['curso']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td>
                            <td width= "30" align="center" onclick="eliminar('.$rs->fields['id_mxg'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>';
    
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}



/*public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE 
    FROM `colegio`.`materiaxgrado` 
    WHERE `id_mxg`= ?";
    $rs = $con->dosql($sql, array($id));
}*/

public function eliminar($id)
{

    $reg              = new Gradoxmateria('materiaxgrado');
    $reg->load("id_mxg = {$id}");
    $reg->Delete();
   
}



  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
                id_estudiante
              FROM
                estudiantexgrado
               WHERE `id_estudiantexgrado`= ?";
    $rs = $db->dosql($sql, array($id));
    return $rs->fields['id_estudiante'];

  }



}

?>