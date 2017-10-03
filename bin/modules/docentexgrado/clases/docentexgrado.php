<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class PlantillaNotas extends ADOdb_Active_Record{}
 class Docentexgrado extends ADOdb_Active_Record{}

class regDocentexgrado
{

public function reg_materia_organizada($mxg,$docente, $anio)
    {
      //var_dump($mxg,$docente, $anio);
      if($this->duplicados($mxg,$docente)){
       throw new Exception('Los datos ya se encuentran registrados.');
      }
      else{
        
         $reg              = new Docentexgrado('materia_organizada');
        //var_dump($reg);
        $reg->cod_mxg      = $mxg;
        $reg->cod_docente = $docente;
        $reg->anio = $anio;
        $reg->estado = 1;
        $reg->Save(); 
       // var_dump($reg->Save());
        return $reg->id_m_o;
      }
       // var_dump($reg->id_m_o);
    }

    public function duplicados($mxg,$docente)
        {
              $db = App::$base;
              $sql = "SELECT materia_organizada.id_m_o
                      FROM materia_organizada
                      WHERE `materia_organizada`.`cod_mxg`= ?
                      AND `materia_organizada`.`cod_docente` = ?";
          $rs = $db->dosql($sql, array($mxg,$docente));
          if($rs->fields['id_m_o'] == NULL){
            return false;}
            else{
              return true;
            }
    }

    public function buscarAnterior($mxg)
        {
              $db = App::$base;
              $sql = "SELECT materia_organizada.id_m_o
                      FROM materia_organizada
                      WHERE `materia_organizada`.`cod_mxg`= ?
                      AND `materia_organizada`.`estado` = 2";
          $rs = $db->dosql($sql, array($mxg));        
              return $rs->fields['id_m_o'];
          
    }

    public function buscarPlantilla($anterior, $ultimo)
        {
              $db = App::$base;
              $sql = "SELECT  id_p_nxm
                      FROM plantilla_notasxmateria
                      WHERE cod_m_o = ?";
          $rs = $db->dosql($sql, array($anterior));        
           while (!$rs->EOF) 
                   {
                    $this->reemplazarPlantilla($rs->fields['id_p_nxm'], $ultimo);
                     $rs->MoveNext();  
                   }

          
    }

    public function reemplazarPlantilla($id,$ultimo){
        $reg              = new PlantillaNotas('plantilla_notasxmateria');
        $reg->load("id_p_nxm = {$id}");
        $reg->cod_m_o     = $ultimo;       
        $reg->Save(); 
}
  

/*public function cambiarEstado($estado,$id)
  {
        $db = App::$base;
        $sql = "UPDATE `colegio`.`estudiante`
                SET id_estado = ?
                WHERE `id_estudiante`= ?";
    $rs = $db->dosql($sql, array($estado,$id));
      // var_dump($rs);
  }*/
public function inactivarMateriaDocente($id, $est){
        $reg              = new Docentexgrado('materia_organizada');
        $reg->load("id_m_o = {$id}");
        $reg->estado     = $est;       
        $reg->Save(); 
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
                           as matricular,

                           \"
                          <button type=\'button\' class=\'btn btn-warning btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
                           <span class=\'glyphicon glyphicon-exclamation-sign\'></span></button>
                           </div>
                            \" 
                           as reemplazar                    
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
                        <th id="yw9_c6">Reemplazar</th>
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
                            </td>
                            <td width= "30" align="center" onclick="reemplazar('.$rs->fields['id_docente'].')">                            
                                '.utf8_encode($rs->fields['reemplazar']).'
                            </td>';
    
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

public function listMatriculados($id)
{
  $con = App::$base;
                $sql = "SELECT 
              `materia_organizada`.`id_m_o`,
              CONCAT(`grado`.`descripcion`,' ',`grado`.`letra`) as curso,
              `materia`.`descripcion`,
              `docente`.`nombre_completo`,
              `grado`.`id_grado`,
              `docente`.`id_docente`,
              `materia_organizada`.`estado`,
              CASE WHEN estado = 1 THEN 'Activo' WHEN estado = 2 THEN 'Inactivo' END as estadogrado,
               \"
              <button type=\'button\' class=\'btn btn-warning btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-off\'></span></button>
               </div>
                \"
                 as inactivar,
                  \"
              <button type=\'button\' class=\'btn btn-success btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-ok\'></span></button>
               </div>
                \"
                 as activar,
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
            where `materiaxgrado`.`cod_grado` =(select cod_grado from materiaxgrado where `materiaxgrado`.`id_mxg` = ? limit 1)
            order by `materia_organizada`.`id_m_o` DESC
                        ";

    $rs = $con->dosql($sql, array($id));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Grado</th>
                        <th id="yw9_c2">Materia</th>
                        <th id="yw9_c2">Docente</th>
                        <th id="yw9_c2">Estado</th>
                        <th id="yw9_c2">Activar/Inactivar</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    if($rs->fields['estado'] == 1)
                    {
                      $boton = '<td width= "30" align="center" onclick="inactivar('.$rs->fields['id_m_o'].')">                            
                                '.utf8_encode($rs->fields['inactivar']).'
                            </td>'; 
                    }
                    else{
                      $boton = '<td width= "30" align="center" onclick="activar('.$rs->fields['id_m_o'].')">                            
                                '.utf8_encode($rs->fields['activar']).'
                            </td>'; 
                    }
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
                            <td>                            
                                '.utf8_encode($rs->fields['estadogrado']).'
                            </td> 
                          
                           
                            '.$boton.'
                            
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


 

 public function identificar_grado2($id_estudiantexgrado)
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

    public function cambiarEstado($estado,$id)
  {
        $db = App::$base;
        $sql = "UPDATE `colegio`.`estudiante`
                SET id_estado = ?
                WHERE `id_estudiante`= ?";
    $rs = $db->dosql($sql, array($estado,$id));
      // var_dump($rs);
  }


  public function identificar_grado($id_mxg)
  {
        $db = App::$base;
        $sql = "SELECT 
              `materiaxgrado`.`cod_grado`             
            FROM
              `materiaxgrado`
          
              WHERE id_mxg=?";

    $rs = $db->dosql($sql, array($id_mxg));

return $rs->fields['cod_grado']; 
      // var_dump($rs);
  }

  public function buscar_id_estudiantesxgrado($cod_grado)
  {
        $db = App::$base;
        $sql = "SELECT 
              `estudiantexgrado`.`id_estudiantexgrado`             
            FROM
              `estudiantexgrado`          
              WHERE id_grado=?
            order by id_estudiantexgrado ASC";
    $rs = $db->dosql($sql, array($cod_grado));

     while (!$rs->EOF) 
                   {

            $resultado[]=$rs->fields['id_estudiantexgrado']; 

                    $rs->MoveNext();  

                   }
                   return $resultado;
      // var_dump($rs);
  }


}

?>