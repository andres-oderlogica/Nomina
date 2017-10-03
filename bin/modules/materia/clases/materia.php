<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Materia extends ADOdb_Active_Record{}
class regMateria
{

public function reg_materia($codigo,$descripcion)
    {
        $reg              = new Materia('materia');
        $reg->codigo      = $codigo;
        $reg->descripcion = $descripcion;
        $reg->Save();
        return $reg->id_materia;
    }


public function listMateria()
{
	$con = App::$base;
    $sql = "SELECT 
			  id_materia,
        codigo,
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
            `materia`
            order by 
            descripcion ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Codigo</th>
                        <th id="yw9_c2">Descripcion</th>
                        <th id="yw9_c4">Editar</th>
                        <th id="yw9_c5">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_materia']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['codigo']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td> 
                                                    
                            <td width= "30" onclick="editar('.$rs->fields['id_materia'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" onclick="eliminar('.$rs->fields['id_materia'].')">                            
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
    FROM `colegio`.`materia` 
    WHERE `id_materia`= ?";
    $rs = $con->dosql($sql, array($id));
}

/*public function editar($id,$cod, $desc)
  {
  //var_dump($id,$cod,$desc);
        $db = App::$base;
        $sql = "UPDATE `colegio`.`materia`
                SET codigo = $cod, `descripcion`= $desc
                WHERE `id_materia`= $id";
    $rs = $db->dosql($sql, array());
       var_dump($rs);
  }*/

  public function editar($id,$cod, $desc)
    {
        $reg              = new Materia('materia');
        $reg->load("id_materia = {$id}");
        $reg->codigo      = $cod;
        $reg->descripcion = $desc;
        $reg->Save();
        //return $reg->id_materia;
    }


  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
  id_materia, codigo, descripcion
FROM
  materia
 WHERE `id_materia`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF) 
                   {

                    $res = array( 
                      "id_materia"  => $rs->fields['id_materia'],
                      "codigo"      => $rs->fields['codigo'],
                      "descripcion" => $rs->fields['descripcion']
                      );

                    $rs->MoveNext();      
                   } 
                   return $res;

  }

}

?>