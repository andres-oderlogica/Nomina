<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Matricula extends ADOdb_Active_Record{}
 class PlantillaNotas extends ADOdb_Active_Record{}
class regMatricula
{

public function reg_matricula($id_estudiante,$id_grado, $id_jornada, $desde, $hasta, $estado)
    {
        $reg              = new Matricula('estudiantexgrado');
        $reg->id_estudiante      = $id_estudiante;
        $reg->id_grado = $id_grado;
        $reg->id_jornada = $id_jornada;
        $reg->desde = $desde;
        $reg->hasta = $hasta;
        $reg->estado_grado = $estado;
        $reg->Save();
        //var_dump($reg);
    }

public function cambiarEstado($estado,$id)
    {
        $reg              = new Matricula('estudiante');
        $reg->load("id_estudiante = {$id}");
        $reg->id_estado      = $estado;      
        $reg->Save();
        //return $reg->id_materia;
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
          
              WHERE `estudiante`.`id_estado` != 1 
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
              `estudiante`.`id_estudiante`,
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
              CONCAT(`grado`.`descripcion`, ' ', `grado`.`letra`) AS `grado`,
              
              `estudiantexgrado`.`estado_grado`,
              `estado_grado`.`descripcion` as estado_estudiante, 
\"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as crear_plantilla,
                    
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
                        <th id="yw9_c2"><input id="todos" type="checkbox" name="todos" /></th>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c2">Grado</th>
                                                <th id="yw9_c2">Estado</th>
                        
                        <th id="yw9_c6">Desvincular</th>
                        <th id="yw9_c7">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    //var_dump($rs->fields['id_estudiantexgrado']);
                    $tabla.='<tr>'; 

                    if($this->existe($rs->fields['id_estudiantexgrado']))
                    {
                      
                      $tabla.='<td></td>';

                    }
                    else
                    {
                      $tabla.='<td><input id="orderBox1'.$rs->fields['id_estudiantexgrado'].'" type="checkbox" name="orderBox[]" value="'.$rs->fields['id_estudiantexgrado'].'" /></td>';
                    }
                    
                             
                    $tabla.='<td>                            
                                '.utf8_encode($rs->fields['id_estudiantexgrado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                             
                            <td>                            
                                '.utf8_encode($rs->fields['grado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['estado_estudiante']).'
                            </td>

                                                                                                                                      
                            <td width= "30" align="center" onclick="editarMatricula('.$rs->fields['id_estudiantexgrado'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" align="center" onclick="eliminar('.$rs->fields['id_estudiantexgrado'].', '.$rs->fields['id_estudiante'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

public function eliminar($id, $est)
{
    $reg              = new Matricula('estudiantexgrado');
    $reg->load("id_estudiantexgrado = {$id}");
    $reg->Delete();
    $this->cambiarEstado('2',$est);
    $this->eliminar_plantilla($id);
}

public function eliminar_plantilla($id)
{
   /* $reg              = new PlantillaNotas('plantilla_notasxmateria');
    $reg->load("id_estudiantexgrado = {$id}");
    $reg->Delete();
    var_dump($reg);*/
     $db = App::$base;
        $sql = "SELECT count(id_estudiantexgrado) as total
                FROM plantilla_notasxmateria
                WHERE id_estudiantexgrado = ?";
    $rs = $db->dosql($sql, array($id));

    for($i = 0; $i<= $rs->fields['total']; $i++)
    {
      $reg              = new PlantillaNotas('plantilla_notasxmateria');
      $reg->load("id_estudiantexgrado = {$id}");
      $reg->Delete();
    }
}



public function desvincular($id)
    {
        $reg              = new Matricula('estudiantexgrado');
        $reg->load("id_estudiantexgrado = {$id}");
        $reg->estado_grado      = 2;
        //$reg->id_estudiantexgrado = $id;
        $reg->Save();
        $this->cambiarEstado("2", $this->buscar($id));
        //return $reg->id_materia;
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


  public function crear_plantilla_de_notas($id_estudiantexgrado)
{
$cod_grado=$this->identificar_grado($id_estudiantexgrado);//var_dump($cod_grado);
$listadoMateriasOrganizadas=$this->buscar_materias_organizadas($cod_grado);
$periodos=$this->listar_periodos();
//var_dump($listadoMateriasOrganizadas);
$cantidad_materias_organizadas=count($listadoMateriasOrganizadas);
$cantidad_periodos=count($periodos);//var_dump(expression)

for ($i=0; $i <$cantidad_materias_organizadas ; $i++)
{ 

  for ($j=0; $j <$cantidad_periodos; $j++) 
  { 
    
    $this->regristrar_plantilla($id_estudiantexgrado,$listadoMateriasOrganizadas[$i],$periodos[$j]);

  }
  # code...
}
  

}

  public function crear_plantilla_de_notas2($id_estudiantexgrado)
{
$cod_grado=$this->identificar_grado($id_estudiantexgrado);//var_dump($cod_grado);
$listadoMateriasOrganizadas=$this->buscar_materias_organizadas($cod_grado);
$periodos=$this->listar_periodos2();
//var_dump($listadoMateriasOrganizadas);
$cantidad_materias_organizadas=count($listadoMateriasOrganizadas);
$cantidad_periodos=count($periodos);//var_dump(expression)

for ($i=0; $i <$cantidad_materias_organizadas ; $i++)
{ 

  for ($j=0; $j <$cantidad_periodos; $j++) 
  { 
    
    $this->regristrar_plantilla($id_estudiantexgrado,$listadoMateriasOrganizadas[$i],$periodos[$j]);

  }
  # code...
}
  

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

  public function listar_periodos2()
  {
    $con = App::$base;
        $sql = "SELECT 
                id_periodo
              FROM
                periodo where id_periodo > 9";
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
               cod_grado= ? and estado=1";
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

     private function existe($id_estudiantexgrado)
  {
    $con = App::$base;
        $sql = "SELECT 
                count(id_p_nxm) as cantidad
              FROM
                plantilla_notasxmateria
               WHERE `id_estudiantexgrado`= ?";
    $rs = $con->dosql($sql, array($id_estudiantexgrado));
    while (!$rs->EOF) // mientras no llegue al final 
                   {
                   $cantidad=$rs->fields['cantidad'];
           
                   $rs->MoveNext();     
                   }
    
    if($cantidad>0){$res=true;}else{$res=false;}
    return $res;

  }

function getGrado()
  {   $con = App::$base;
       $sql="SELECT id_grado
        from grado 
         ";
    $rs = $con->dosql($sql, array()); 
        while (!$rs->EOF) 
           {
           $data[] = $rs->fields['id_grado'];
                                         
  
            $rs->MoveNext();      
            }              
          
       return $data;
  }



  public function listMatriculados2($grado)
{
  $con = App::$base;
    $sql = "SELECT 
              `estudiantexgrado`.`id_estudiantexgrado`,
              `estudiante`.`id_estudiante`,
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
              CONCAT(`grado`.`descripcion`, ' ', `grado`.`letra`) AS `grado`,
              
              `estudiantexgrado`.`estado_grado`,
              `estado_grado`.`descripcion` as estado_estudiante 
               
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
      
              while (!$rs->EOF) 
                   {
                    $resultado[]=$rs->fields['id_estudiantexgrado'];

                                                       
  
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}


}

?>