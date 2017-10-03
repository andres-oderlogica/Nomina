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

public function materias($docente)
{
  $con = App::$base;
    $sql = "SELECT 
              `materia_organizada`.`id_m_o`,
              `materia`.`descripcion`,
               CONCAT(`grado`.`descripcion`,' ',`grado`.`letra` ) as curso,
              `grado`.`id_grado`
                          /*   \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as calificar*/
                                 
            FROM
              `materia_organizada`,`materiaxgrado`,`materia`,`grado`
            WHERE
            
            `cod_mxg`=`id_mxg` and
            `cod_materia`=`id_materia` and
            cod_grado = id_grado and
             `materia_organizada`.cod_docente = ?
            
            order by `materia`.`descripcion` ASC
                        ";

    $rs = $con->dosql($sql, array($docente));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Materia</th>
                        <th id="yw9_c2">Grado</th>
                        <th id="yw9_c2">Calificar</th>
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
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['curso']).'
                            </td> 
                                                                                                                                     
                            <td width= "30" align="center" onclick="calificar('.$rs->fields['id_m_o'].')"> 

                                       
                                <a href="estudiantes.php?id_m_o='.$rs->fields['id_m_o'].'"><button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button></a>
                            </td>'
                            
                                                        ;                                                                               
                            
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
/*  public function listMatriculados2($grado,$periodo)
{
  $con = App::$base;
    $sql = "SELECT 
              `plantilla_notasxmateria`.`id_p_nxm`,
                            CONCAT(`estudiante`.`primer_apellido`, ' ', 
            IFNULL(`estudiante`.`segundo_apellido`, ''), ' ', 
            `estudiante`.`primer_nombre`, ' ', 
            IFNULL(`estudiante`.`segundo_nombre`, '')) AS `nombre`,
              `plantilla_notasxmateria`.`n1`,
              `plantilla_notasxmateria`.`n2`,
              `plantilla_notasxmateria`.`n3`,
              `plantilla_notasxmateria`.`n4`,
              `plantilla_notasxmateria`.`n5`,
              `plantilla_notasxmateria`.`n6`,
              `plantilla_notasxmateria`.`n7`,
              `plantilla_notasxmateria`.`n8`,
              `plantilla_notasxmateria`.`n9`,
           

              
                                  \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as actualizar
              
                                 
            FROM `plantilla_notasxmateria`,`estudiantexgrado`,`estudiante`
              
            WHERE
            `plantilla_notasxmateria`.`id_estudiantexgrado`=`estudiantexgrado`.`id_estudiantexgrado` and
            `estudiantexgrado`.`id_estudiante`=`estudiante`.`id_estudiante` and
            `plantilla_notasxmateria`.`cod_m_o`= ? and
`plantilla_notasxmateria`.`cod_periodo`= ?
            AND 
            `estudiantexgrado`.`estado_grado` = 1 
            order by nombre ASC
                        ";

    $rs = $con->dosql($sql, array($grado,$periodo));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c1">Nota 1</th>
                        <th id="yw9_c1">Nota 2</th>
                        <th id="yw9_c1">Nota 3</th>
                        <th id="yw9_c2">Nota 4</th>
                        <th id="yw9_c2">Nota 5</th>
                        <th id="yw9_c2">Nota 6</th>
                        <th id="yw9_c2">Nota 7</th>
                        <th id="yw9_c2">Nota 8</th>
                        <th id="yw9_c2">50%</th>
                        <th id="yw9_c2">50%</th>
                        <th id="yw9_c2">100%</th>                      
                        <th id="yw9_c2">Actualizar</th>
                        

                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
$acumulado=$this->calcular_acumulado($rs->fields['n1'],$rs->fields['n2'],$rs->fields['n3'],$rs->fields['n4'],$rs->fields['n5'],$rs->fields['n6'],$rs->fields['n7'],
                    $rs->fields['n8'],$rs->fields['n9']);

                    $C50=$acumulado['total_30']+$rs->fields['n9'];
                    $tabla.='<tr >  
                            
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                            </td>
                            <td>                            
          <input class="form-control" id="n1'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n1']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n2'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n2']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n3'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n3']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n4'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n4']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n5'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n5']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n6'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n6']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n7'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n7']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n8'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n8']).'>
                
                            </td>
                            <td>'.$acumulado['total_30'].
                            '</td>
                            <td>                            
          <input class="form-control" id="n9'.$rs->fields['id_p_nxm'].'" name="direccion" type="number" value='.utf8_encode($rs->fields['n9']).'>
                
                            </td>                            
                            
                            <td>'.$C50.
                            '</td>
                            <td width= "30" align="center" onclick="actualizar('.$rs->fields['id_p_nxm'].')">                            
                                '.utf8_encode($rs->fields['actualizar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

} */

public function listMatriculados2($grado,$periodo)
{
  $con = App::$base;
    $sql = "SELECT 
              `plantilla_notasxmateria`.`id_p_nxm`,
                            CONCAT(`estudiante`.`primer_apellido`, ' ', 
            IFNULL(`estudiante`.`segundo_apellido`, ''), ' ', 
            `estudiante`.`primer_nombre`, ' ', 
            IFNULL(`estudiante`.`segundo_nombre`, '')) AS `nombre`,
              `plantilla_notasxmateria`.`n1`,
              `plantilla_notasxmateria`.`n2`,
              `plantilla_notasxmateria`.`n3`,
              `plantilla_notasxmateria`.`n4`,
              `plantilla_notasxmateria`.`n5`,
              `plantilla_notasxmateria`.`n6`,
              `plantilla_notasxmateria`.`n7`,
              `plantilla_notasxmateria`.`n8`,
              `plantilla_notasxmateria`.`n9`,
           

              
                                  \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' >
               <span class=\'glyphicon glyphicon-minus-sign\'></span></button>
               </div>
                \" 
               as actualizar
              
                                 
            FROM `plantilla_notasxmateria`,`estudiantexgrado`,`estudiante`
              
            WHERE
            `plantilla_notasxmateria`.`id_estudiantexgrado`=`estudiantexgrado`.`id_estudiantexgrado` and
            `estudiantexgrado`.`id_estudiante`=`estudiante`.`id_estudiante` and
            `plantilla_notasxmateria`.`cod_m_o`= ? and
`plantilla_notasxmateria`.`cod_periodo`= ?
            AND 
            `estudiantexgrado`.`estado_grado` = 1 
            order by nombre ASC
                        ";

    $rs = $con->dosql($sql, array($grado,$periodo));
        $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c1">Nota 1</th>
                        <th id="yw9_c1">Nota 2</th>
                        <th id="yw9_c1">Nota 3</th>
                        <th id="yw9_c2">Nota 4</th>
                        <th id="yw9_c2">Nota 5</th>
                        <th id="yw9_c2">Nota 6</th>
                        <th id="yw9_c2">Nota 7</th>
                        <th id="yw9_c2">Nota 8</th>
                        <th id="yw9_c2">50%</th>
                        <th id="yw9_c2">50%</th>
                        <th id="yw9_c2">%100</th>
                      
                                                <th id="yw9_c2">Actualizar</th>
                        

                        </tr>
                        </thead>
                        <tbody>';
              while (!$rs->EOF) 
                   {
                    $ids[]=utf8_encode($rs->fields['id_p_nxm']);
$acumulado=$this->calcular_acumulado($rs->fields['n1'],$rs->fields['n2'],$rs->fields['n3'],$rs->fields['n4'],$rs->fields['n5'],$rs->fields['n6'],$rs->fields['n7'],
                    $rs->fields['n8'],$rs->fields['n9']);

                    $C50=$acumulado['total_30']+$rs->fields['n9'];
                    $tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_p_nxm']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre']).'
                            </td>
                            <td>                            
          <input class="form-control" id="n1'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n1']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n2'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n2']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n3'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n3']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n4'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n4']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n5'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n5']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n6'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n6']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n7'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n7']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n8'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n8']).'>
                
                            </td>
                            <td>'.$acumulado['total_30'].
                            '</td>
                            <td>                            
          <input class="form-control" id="n9'.$rs->fields['id_p_nxm'].'" name="direccion" placeholder="Digita la direccion" type="text" value='.utf8_encode($rs->fields['n9']).'>
                
                            </td>                            
                            
                            <td>'.$C50.
                            '</td>
                            <td width= "30" align="center" onclick="actualizar('.$rs->fields['id_p_nxm'].')">                            
                                '.utf8_encode($rs->fields['actualizar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";


        $res[0]=$ids;
        $res[1]=$tabla;

        return $res;

}

/*public function actualizar($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9,$id_p_nxm)
  {
    $db = App::$base;
        $sql = "UPDATE plantilla_notasxmateria
                SET n1 = ?, n2 = ?, n3 = ?, n4 = ?, n5 = ?, n6 = ?, n7 = ?, n8 = ?, n9 = ?
                WHERE id_p_nxm= ?";
                if($n1==""){$n1=null;}
                if($n2==""){$n2=null;}
                if($n3==""){$n3=null;}
                if($n4==""){$n4=null;}
                if($n5==""){$n5=null;}
                if($n6==""){$n6=null;}
                if($n7==""){$n7=null;}
                if($n8==""){$n8=null;}
                if($n9==""){$n9=null;}
                
    $rs = $db->dosql($sql, array($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9,$id_p_nxm));

  }*/

  public function actualizar($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9,$id_p_nxm)
    {
        $reg              = new Matricula('plantilla_notasxmateria');
        $reg->load("id_p_nxm = {$id_p_nxm}");
                if($n1==""){$n1=null;}
                if($n2==""){$n2=null;}
                if($n3==""){$n3=null;}
                if($n4==""){$n4=null;}
                if($n5==""){$n5=null;}
                if($n6==""){$n6=null;}
                if($n7==""){$n7=null;}
                if($n8==""){$n8=null;}
                if($n9==""){$n9=null;}
        $reg->n1  =$n1;
        $reg->n2  = $n2;
        $reg->n3  = $n3;
        $reg->n4 = $n4;
        $reg->n5 = $n5;
        $reg->n6 = $n6;
        $reg->n7 = $n7;
        $reg->n8 = $n8;
        $reg->n9 = $n9;
        $reg->Save();
        //return $reg->id_estudiante;
    }


  public function calcular_acumulado($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8,$n9)
  {
          
          $treinta=array($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8);
          $veinte=array($n9);
          $acumuladoTreinta=0;
          $acumuladoVeinte=0;
          $cantidadNotasTreinta=0;
          $cantidadNotasVeinte=0;

          for ($i=0; $i <count($treinta) ; $i++) { 
            if($treinta[$i]!=null)
            {
              $acumuladoTreinta+=$treinta[$i];
              $cantidadNotasTreinta++;
       
            }
          }

          for ($i=0; $i <count($veinte) ; $i++) { 
            if($veinte[$i]!=null)
            {
       $acumuladoVeinte+=$veinte[$i];
       $cantidadNotasVeinte++;

            }
          }

         
         
          /*if($cantidadNotasTreinta>0){$promedioTreinta=$acumuladoTreinta/$cantidadNotasTreinta;}else{$promedioTreinta=0;}
          if($cantidadNotasVeinte>0){$promedioVeinte=$acumuladoVeinte/$cantidadNotasVeinte;}else{$promedioVeinte=0;}

          $porcentaje30=$promedioTreinta*0.3;
          $porcentaje20=$promedioVeinte*0.2;*/

       return $array=array("total_30"=>$acumuladoTreinta,"total_20"=>$acumuladoVeinte);
      
  }


}

?>