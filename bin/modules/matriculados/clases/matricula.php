<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Matricula extends ADOdb_Active_Record{}
class regMatricula
{

public function reg_matricula($id_estudiante,$id_grado, $id_jornada, $id_docente, $desde, $hasta, $estado)
    {
        $reg              = new Matricula('estudiantexgrado');
        $reg->id_estudiante      = $id_estudiante;
        $reg->id_grado = $id_grado;
        $reg->id_jornada = $id_jornada;
        $reg->id_docente = $id_docente;
        $reg->desde = $desde;
        $reg->hasta = $hasta;
        $reg->estado_grado = $estado;
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


public function listMatricula()
{
	$con = App::$base;
    $sql = "SELECT 
  `estudiante`.`id_estudiante`,
  CONCAT(`estudiante`.`primer_apellido`,' ',
  IFNULL(`estudiante`.`segundo_apellido`,''),' ',
  `estudiante`.`primer_nombre`,' ',
  IFNULL(`estudiante`.`segundo_nombre`,'')) AS nombre,
  `estudiante`.`codigo`,
  `estudiante`.`email`,
  `estudiante`.`identificacion`,         
               \"
              <button type=\'button\' class=\'btn btn-success btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-hand-right\'></span></button>
               </div>
                \" 
               as matricular                    
            FROM
              `estudiante`
            WHERE
              `estudiante`.`id_estado`= 2
              
            order by nombre ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Codigo</th>
                        <th id="yw9_c1">Identificacion</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c2">Email</th>
                        <th id="yw9_c6">Matricular</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_estudiante']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['email']).'
                            </td>
                                                                                                         
                            <td width= "30" align="center" onclick="editar('.$rs->fields['id_estudiante'].')">                            
                                '.utf8_encode($rs->fields['matricular']).'
                            </td>';
    
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

public function listMatriculados($grado)
{
  $con = App::$base;
    $sql = "SELECT 
              `estudiantexgrado`.`id_estudiantexgrado`,
              `estudiante`.`primer_apellido`,
              `estudiante`.`segundo_apellido`,
              `estudiante`.`primer_nombre`,
              `estudiante`.`segundo_nombre`,
              CONCAT(`estudiante`.`primer_apellido`, ' ', 
            IFNULL(`estudiante`.`segundo_apellido`, ''), ' ', 
            `estudiante`.`primer_nombre`, ' ', 
            IFNULL(`estudiante`.`segundo_nombre`, '')) AS `nombre`,
              `grado`.`letra`,
              `grado`.`descripcion`,
              CONCAT(`grado`.`descripcion`,' ',`grado`.`letra` ) as curso,
              `grado`.`numero`,
              `grado`.`id_grado`,
              `docente`.`nombre_completo`,
              `estudiantexgrado`.`estado_grado`,
              `estado_grado`.`descripcion` as estado_estudiante,       
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as editar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as borrar                    
            FROM
              `estudiante`
              INNER JOIN `estudiantexgrado` ON (`estudiante`.`id_estudiante` = `estudiantexgrado`.`id_estudiante`)
              INNER JOIN `grado` ON (`estudiantexgrado`.`id_grado` = `grado`.`id_grado`)
              INNER JOIN `jornada` ON (`estudiantexgrado`.`id_jornada` = `jornada`.`id_jornada`)
              INNER JOIN `docente` ON (`estudiantexgrado`.`id_docente` = `docente`.`id_docente`)
              INNER JOIN `estado_grado` ON (`estudiantexgrado`.`estado_grado` = `estado_grado`.`id_estado`)
            WHERE
            grado.id_grado = ?
            AND 
            `estudiantexgrado`.`estado_grado` = 1 
            order by nombre ASC
                        ";

    $rs = $con->dosql($sql, array($grado));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c2">Grado</th>
                        <th id="yw9_c2">Docente</th>
                        <th id="yw9_c2">Estado</th>
                        <th id="yw9_c6">Desvincular</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    $tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_estudiantexgrado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['curso']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['estado_estudiante']).'
                            </td>
                                                                                                         
                            <td width= "30" align="center" onclick="editarMatricula('.$rs->fields['id_estudiantexgrado'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" align="center" onclick="eliminar('.$rs->fields['id_estudiantexgrado'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE 
    FROM `colegio`.`docente` 
    WHERE `id_docente`= ?";
    $rs = $con->dosql($sql, array($id));
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

  ///////////////////////////////////////////////////////// 1.1/////////////////////////////////////////
  public function listMatriculados2($grado)
{
  $con = App::$base;
    $sql = "SELECT 
              `estudiantexgrado`.`id_estudiantexgrado`,
              `estudiante`.`primer_apellido`,
              `estudiante`.`segundo_apellido`,
              `estudiante`.`primer_nombre`,
              `estudiante`.`segundo_nombre`,
              CONCAT(`estudiante`.`primer_apellido`, ' ', 
            IFNULL(`estudiante`.`segundo_apellido`, ''), ' ', 
            `estudiante`.`primer_nombre`, ' ', 
            IFNULL(`estudiante`.`segundo_nombre`, '')) AS `nombre`,
              `grado`.`letra`,
              `grado`.`descripcion`,
              CONCAT(`grado`.`descripcion`,' ',`grado`.`letra` ) as curso,
              `grado`.`numero`,
              `grado`.`id_grado`,
                           `estudiantexgrado`.`estado_grado`,
              `estado_grado`.`descripcion` as estado_estudiante,       
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as editar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as borrar                    
            FROM
              `estudiante`
              INNER JOIN `estudiantexgrado` ON (`estudiante`.`id_estudiante` = `estudiantexgrado`.`id_estudiante`)
              INNER JOIN `grado` ON (`estudiantexgrado`.`id_grado` = `grado`.`id_grado`)
              INNER JOIN `jornada` ON (`estudiantexgrado`.`id_jornada` = `jornada`.`id_jornada`)
                            INNER JOIN `estado_grado` ON (`estudiantexgrado`.`estado_grado` = `estado_grado`.`id_estado`)
            WHERE
            grado.id_grado = ?
            AND 
            `estudiantexgrado`.`estado_grado` = 1 
            order by nombre ASC
                        ";

    $rs = $con->dosql($sql, array($grado));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c2">Grado</th>
                        <th id="yw9_c2">Docente</th>
                        <th id="yw9_c2">Estado</th>
                        <th id="yw9_c6">Desvincular</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    $tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_estudiantexgrado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['curso']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['estado_estudiante']).'
                            </td>
                                                                                                         
                            <td width= "30" align="center" onclick="crearPlantillaNotas('.$rs->fields['id_estudiantexgrado'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" align="center" onclick="eliminar('.$rs->fields['id_estudiantexgrado'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

}

?>