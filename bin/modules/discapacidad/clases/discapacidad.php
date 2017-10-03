<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Discapacidad extends ADOdb_Active_Record{}
class regdiscapacidad
{

public function reg_discapacidad($descripcion)
    {
        $reg              = new Discapacidad('discapacidad');
        $reg->descripcion = $descripcion;
        $reg->Save();
        return $reg->id_discapacidad;
    }


public function listDiscapacidad()
{
	$con = App::$base;
    $sql = "SELECT 
			  id_discapacidad,
			  descripcion,
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
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
            `discapacidad`
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">Codigo</th>
                        <th id="yw9_c1">Descripcion</th>                      
                        <th id="yw9_c5">Editar</th>
                        <th id="yw9_c6">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_discapacidad']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td>                       
                           
                            <td width= "30" onclick="editar('.$rs->fields['id_discapacidad'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" onclick="eliminar('.$rs->fields['id_discapacidad'].')">                            
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
    FROM `colegio`.`discapacidad` 
    WHERE `id_discapacidad`= ?";
    $rs = $con->dosql($sql, array($id));
}

public function editar($id,$desc)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`discapacidad` 
                SET `descripcion`= ?
                WHERE `id_discapacidad`= ?";
    $rs = $db->dosql($sql, array($desc,$id));
       //var_dump($sql);
  }

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
  id_discapacidad, descripcion
FROM
  discapacidad
 WHERE `id_discapacidad`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF) 
                   {

                    $res = array( "id_discapacidad" => $rs->fields['id_discapacidad'],
                      "descripcion" => $rs->fields['descripcion']
                      );

                    $rs->MoveNext();      
                   } 
                   return $res;

  }

}

?>