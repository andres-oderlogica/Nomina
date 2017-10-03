<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 //class Matricula extends ADOdb_Active_Record{}
 class Docentexgrado extends ADOdb_Active_Record{}
class regDocentexgrado
{

public function reg_materia_organizada($mxg,$docente, $anio)
    {
      //var_dump($mxg,$docente, $anio);
        $reg              = new Docentexgrado('materia_organizada');
        //var_dump($reg);
        $reg->cod_mxg      = $mxg;
        $reg->cod_docente = $docente;
        $reg->anio = $anio;
        $reg->Save();
       // var_dump($reg->Save());
        //return $docente;
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


public function listDocentexgrado()
{
	$con = App::$base;
    $sql = "SELECT 
              `docente`.`id_docente`,
              `perfil`.`descripcion`,
              `docente`.`nombre_completo`,
              ifnull(`docente`.`user_email`,'Sin Asignar') as user_email,         
                           \"
                          <button type=\'button\' class=\'btn btn-success btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
                           <span class=\'glyphicon glyphicon-hand-right\'></span></button>
                           </div>
                            \" 
                           as matricular                    
                        FROM
              `perfil`
              INNER JOIN `docente` ON (`perfil`.`id_perfil` = `docente`.`cod_perfil`)
              WHERE id_perfil = 1 
                        order by nombre_completo ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Nombre Docente</th>
                        <th id="yw9_c1">Email</th>
                        <th id="yw9_c2">Rol</th>
                        <th id="yw9_c6">Asignar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_docente']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['user_email']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td>
                                                                                                                                     
                            <td width= "30" align="center" onclick="editar('.$rs->fields['id_docente'].')">                            
                                '.utf8_encode($rs->fields['matricular']).'
                            </td>';
    
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

public function listMatriculados()
{
  $con = App::$base;
                $sql = "SELECT 
              `materia_organizada`.`id_m_o`,
              CONCAT(`grado`.`descripcion`,' ',`grado`.`letra`) as curso,
              `materia`.`descripcion`,
              `docente`.`nombre_completo`,
              `grado`.`id_grado`,
              `docente`.`id_docente`,
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
            INNER JOIN `materia_organizada` ON (`materiaxgrado`.`id_mxg` = `materia_organizada`.`cod_mxg`)
            INNER JOIN `docente` ON (`materia_organizada`.`cod_docente` = `docente`.`id_docente`)
            order by id_m_o ASC
                        ";

    $rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Grado</th>
                        <th id="yw9_c2">Materia</th>
                        <th id="yw9_c2">Docente</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    $tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_m_o']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['curso']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            
                            <td width= "30" align="center" onclick="eliminar('.$rs->fields['id_m_o'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

/*public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE FROM `colegio`.`materia_organizada` WHERE `id_m_o`= ?";
    $rs = $con->dosql($sql, array($id));
}*/

public function eliminar($id)
{
    $reg              = new Docentexgrado('materia_organizada');
    $reg->load("id_m_o = {$id}");
    $reg->Delete();
}

public function desvincular($id)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`estudiantexgrado`
                SET  estado_grado = ?
                WHERE `id_estudiantexgrado`= ?";
    $rs = $db->dosql($sql, array("2",$id));
    $this->cambiarEstado("2", $this->buscar($id));
      // var_dump($rs);
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


 

 public function identificar_grado($id_estudiantexgrado)
  {
    $con = App::$base;
        $sql = "SELECT 
                id_grado
              FROM
                estudiantexgrado
               WHERE `id_estudiantexgrado`= ?";
    $rs = $con->dosql($sql, array($id_estudiantexgrado));
    return $rs->fields['id_grado'];

  }

  public function listar_periodos()
  {
    $con = App::$base;
        $sql = "SELECT 
                id_periodo
              FROM
                periodo";
    $rs = $con->dosql($sql, array());
    while (!$rs->EOF) 
                   {
                                              
                              
                                                                                                         
                         $data[]=$rs->fields['id_periodo'];                            
                                                               
  
                 $rs->MoveNext();     
                   }  
    
    return $data;

  }

   public function buscar_materias_organizadas($grado)
  {
    $con = App::$base;
        $sql = "SELECT 
                id_m_o
              FROM
                materia_organizada,materiaxgrado
               WHERE 
               cod_mxg=id_mxg AND
               cod_grado= ?";
    $rs = $con->dosql($sql, array($grado));
        
              while (!$rs->EOF) 
                   {
                                              
                              
                                                                                                         
                         $data[]=$rs->fields['id_m_o'];                            
                                                               
  
                 $rs->MoveNext();     
                   }  
            

    return $data;

  }

  public function regristrar_plantilla($id_estudiantexgrado,$cod_m_o,$cod_periodo)
    {
        $reg              = new PlantillaNotas('plantilla_notasxmateria');
        $reg->id_estudiantexgrado = $id_estudiantexgrado;
        $reg->cod_m_o = $cod_m_o;
        $reg->cod_periodo = $cod_periodo;
        $reg->faltas = null;
        $reg->n1 = null;
        $reg->n2 = null;
        $reg->n3 = null;
        $reg->n4 = null;
        $reg->n5 = null;
        $reg->n6 = null;
        $reg->n7 = null;
        $reg->n8 = null;
        $reg->n9 = null;
        $reg->n10 = null;
        $reg->n11 = null;
        $reg->n12 = null;
        
        $reg->Save();
        //var_dump($reg);
    }

}

?>