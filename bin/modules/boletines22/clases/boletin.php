<?php

//include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
class boletin
{
public function buscar_materias_organizadasxgrado($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT 
             id_m_o,materia.descripcion as descripcion 
          
            FROM
            materia_organizada,materiaxgrado,materia
              
            WHERE

            cod_mxg=id_mxg and
            cod_materia=id_materia and
            cod_grado=?
             
              
            order by prioridad,descripcion";

    $rs = $con->dosql($sql, array($cod_grado));
        
              while (!$rs->EOF) 
                   {
                    $resultado[]=array('id_m_o'=>$rs->fields['id_m_o'],'descripcion'=>$rs->fields['descripcion']);
                    
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}

public function buscar_abre_materias_organizadasxgrado($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT 
             id_m_o,materia.abre as descripcion 
          
            FROM
            materia_organizada,materiaxgrado,materia
              
            WHERE

            cod_mxg=id_mxg and
            cod_materia=id_materia and
            cod_grado=?
             
              
            order by prioridad,descripcion";

    $rs = $con->dosql($sql, array($cod_grado));
        
              while (!$rs->EOF) 
                   {
                    $resultado[]=array('id_m_o'=>$rs->fields['id_m_o'],'descripcion'=>$rs->fields['descripcion']);
                    
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}

public function validarUsuarioEstudiante($id, $user)
{
  $con = App::$base;
    $sql = "SELECT id_estudiante 
            from estudiante 
            where id_estudiante = ? 
            and usuario = ?";
    $rs = $con->dosql($sql, array($id, $user));           
        
        return $rs->fields['id_estudiante'];

}

public function validarPago($id)
{
  $con = App::$base;
    $sql = "SELECT idestado_pago 
            from estudiante 
            where id_estudiante = ?";
    $rs = $con->dosql($sql, array($id));           
        
        return $rs->fields['idestado_pago'];

}

public function listar_notas2($estudiante,$materia,$periodo)
{
 $con = App::$base;
   $sql = "SELECT 
             `plantilla_notasxmateria`.`n1`,
             `plantilla_notasxmateria`.`n2`,
             `plantilla_notasxmateria`.`n3`,
             `plantilla_notasxmateria`.`n4`,
             `plantilla_notasxmateria`.`n5`,
             `plantilla_notasxmateria`.`n6`,
             `plantilla_notasxmateria`.`n7`,
             `plantilla_notasxmateria`.`n8`,
             `plantilla_notasxmateria`.`n9`              
                                
           FROM `plantilla_notasxmateria`
             
           WHERE
           `plantilla_notasxmateria`.`id_estudiantexgrado`= ? and
           `plantilla_notasxmateria`.`cod_m_o`= ? and
`plantilla_notasxmateria`.`cod_periodo`= ?";

   $rs = $con->dosql($sql, array($estudiante,$materia,$periodo));
       
             while (!$rs->EOF) 
                  {
$acumulado=$this->calcular_acumulado($rs->fields['n1'],$rs->fields['n2'],$rs->fields['n3'],$rs->fields['n4'],$rs->fields['n5'],$rs->fields['n6'],$rs->fields['n7'],
             $rs->fields['n8'],$rs->fields['n9']);

                   $C50=$acumulado['total_30']+$rs->fields['n9'];
                   //$letra=$this->identificar_letra($C50);
                   $resultado=array('n1'=>$rs->fields['n1'],'n2'=>$rs->fields['n2'],'n3'=>$rs->fields['n3'],'n4'=>$rs->fields['n4'],'n5'=>$rs->fields['n5'],'n6'=>$rs->fields['n6'],'n7'=>$rs->fields['n7'],'n8'=>$rs->fields['n8'],'n9'=>$rs->fields['n9'],'acumulado'=>$acumulado['total_30'],'prueba'=>$rs->fields['n9'],'acumulado50'=>$C50);
 
                $rs->MoveNext();     
                  }  
           
       
       return $resultado;

}

public function buscar_estudiantesxgrado($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT  
             id_estudiantexgrado,
             CONCAT(`estudiante`.`primer_apellido`,' ',
  IFNULL(`estudiante`.`segundo_apellido`,''),' ',
  `estudiante`.`primer_nombre`,' ',
  IFNULL(`estudiante`.`segundo_nombre`,'')) AS nombre 
          
            FROM
            estudiantexgrado,estudiante
              
            WHERE

            estudiantexgrado.id_estudiante=estudiante.id_estudiante and
            estudiantexgrado.id_grado=?
            and estado_grado=1
             
              
            order by nombre ASC";

    $rs = $con->dosql($sql, array($cod_grado));
        
              while (!$rs->EOF) 
                   {
                    $resultado[]=array('id_estudiante'=>$rs->fields['id_estudiantexgrado'],'nombre'=>$rs->fields['nombre']);
                    
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}

public function buscar_estudiantesxgrado_para_promedio($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT  
             id_estudiantexgrado,
             CONCAT(`estudiante`.`primer_nombre`,' ',
  IFNULL(`estudiante`.`segundo_nombre`,''),' ',`estudiante`.`primer_apellido`,' ',
  IFNULL(`estudiante`.`segundo_apellido`,'')) AS nombre 
          
            FROM
            estudiantexgrado,estudiante
              
            WHERE

            estudiantexgrado.id_estudiante=estudiante.id_estudiante and
            estudiantexgrado.id_grado=?
            and estado_grado=1
             
              
            order by nombre ASC";

    $rs = $con->dosql($sql, array($cod_grado));
        
              while (!$rs->EOF) 
                   {
                    $resultado[]=array('id_estudiante'=>$rs->fields['id_estudiantexgrado'],'nombre'=>$rs->fields['nombre']);
                    
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}


public function listar_notas($estudiante,$materia,$periodo)
{
  $con = App::$base;
    $sql = "SELECT 
              `plantilla_notasxmateria`.`n1`,
              `plantilla_notasxmateria`.`n2`,
              `plantilla_notasxmateria`.`n3`,
              `plantilla_notasxmateria`.`n4`,
              `plantilla_notasxmateria`.`n5`,
              `plantilla_notasxmateria`.`n6`,
              `plantilla_notasxmateria`.`n7`,
              `plantilla_notasxmateria`.`n8`,
              `plantilla_notasxmateria`.`n9`              
                                 
            FROM `plantilla_notasxmateria`
              
            WHERE
            `plantilla_notasxmateria`.`id_estudiantexgrado`= ? and
            `plantilla_notasxmateria`.`cod_m_o`= ? and
`plantilla_notasxmateria`.`cod_periodo`= ?";

    $rs = $con->dosql($sql, array($estudiante,$materia,$periodo));
        
              while (!$rs->EOF) 
                   {
$acumulado=$this->calcular_acumulado($rs->fields['n1'],$rs->fields['n2'],$rs->fields['n3'],$rs->fields['n4'],$rs->fields['n5'],$rs->fields['n6'],$rs->fields['n7'],
              $rs->fields['n8'],$rs->fields['n9']);

                    $C50=$acumulado['total_30']+$rs->fields['n9'];
                    //$letra=$this->identificar_letra($C50);
                    $resultado=array('acumulado'=>$acumulado['total_30'],'prueba'=>$rs->fields['n9']);
  
                 $rs->MoveNext();     
                   }  
            
        
        return $resultado;

}

  public function identificar_letra($total)
  {
    //var_dump($total);
   

    if(90<=$total && $total<=100)
    {
      return 'AA';

    }
  else
  {
    if(76<=$total && $total<=89)
    {
      return 'AS';

    }
    else
    {
      if(60<=$total && $total<=75)
    {
      return 'AE';

    }
    else
    {
      return 'AI';
    }

    }


  }

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

  public function identificar_grado($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT id_grado, CONCAT(descripcion,'-',letra) as curso 
        from grado where id_grado=?";

    $rs = $con->dosql($sql, array($cod_grado));
        
              
                    $resultado=$rs->fields['curso'];
                    
                
            
        
        return $resultado;

}

public function identificar_parciales($corte)
{
  switch ($corte) {
      case 0:
      $resultado[0]=6;
      $resultado[1]=7;
      break;
      case 1:
      $resultado[0]=8;
      $resultado[1]=9;
      break;
      case 2:
      $resultado[0]=10;//**pednientes**//
      $resultado[1]=11;//**pednientes**//
      break;
      case 3:
      $resultado[0]=12;//**pednientes**//
      $resultado[1]=13;//**pednientes**//
      break;
    
    
  }
            
        return $resultado;
        

}

public function identificar_director_grado($cod_grado)
{
  $con = App::$base;
    $sql = "SELECT nombre_completo FROM materia_organizada,docente,materiaxgrado,grado 
WHERE cod_docente=id_docente AND
cod_mxg=id_mxg AND
cod_grado=id_grado AND
/*cod_materia=23 AND  este es para la bd del servidor*/ 
cod_materia=23 AND
cod_grado=?";

    $rs = $con->dosql($sql, array($cod_grado));
        
              
                    $resultado=$rs->fields['nombre_completo'];
                    
                
            
        
        return $resultado;

}

public function identificar_grado_del_estudiante($id_estudiante)
{
  $con = App::$base;
    $sql = "SELECT id_grado
        from estudiantexgrado where id_estudiante=? and
        estado_grado=1";

    $rs = $con->dosql($sql, array($id_estudiante));
        
              
                    $resultado=$rs->fields['id_grado'];
                    
                
            
        
        return $resultado;

}

public function identificar_id_estudiantexgrado($id_estudiante,$cod_grado)
{
  $con = App::$base;
    $sql = "SELECT  
             id_estudiantexgrado         
          
            FROM
            estudiantexgrado
            WHERE
            id_estudiante=? and
            id_grado=? 

            and estado_grado=1";

    $rs = $con->dosql($sql, array($id_estudiante,$cod_grado));
        
              $resultado=$rs->fields['id_estudiantexgrado'];
               
        
        return $resultado;

}

public function identificar_estudiante($id_estudiante)
{
  $con = App::$base;
    $sql = "SELECT  
             
             CONCAT(`estudiante`.`primer_apellido`,' ',
  IFNULL(`estudiante`.`segundo_apellido`,''),' ',
  `estudiante`.`primer_nombre`,' ',
  IFNULL(`estudiante`.`segundo_nombre`,'')) AS nombre 
          
            FROM
            estudiante
              
            WHERE id_estudiante=?";

    $rs = $con->dosql($sql, array($id_estudiante));
        
              
                    $resultado=$rs->fields['nombre'];
                
            
        
        return $resultado;

}

public function identificar_cantidad_de_cortes($semestre)
{
  switch ($semestre) {
      
      case 1:
      $resultado=2;
      
      break;
      case 2:
      $resultado=4;
      break;
      
    
    
  }
            
        return $resultado;
        

}
 


}

?>