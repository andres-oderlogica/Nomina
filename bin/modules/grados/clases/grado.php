<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Grado extends ADOdb_Active_Record{}
class regGrado
{

public function reg_grado($descripcion,$letra,$numero)
    {
        $reg              = new Grado('grado');
        $reg->descripcion      = $descripcion;
        $reg->numero = $numero;
        $reg->letra = $letra;
        $reg->Save();
        return $reg->id_grado;
    }


public function listGrado()
{
	$con = App::$base;
    $sql = "SELECT 
			  id_grado,
        letra,
			  descripcion,
        numero,        
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
            `grado`
            order by 
            descripcion ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Descripcion</th>
                        <th id="yw9_c2">letra</th>
                        <th id="yw9_c4">Editar</th>
                        <th id="yw9_c5">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['id_grado']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['descripcion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['letra']).'
                            </td> 
                                                    
                            <td width= "30" onclick="editar('.$rs->fields['id_grado'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" onclick="eliminar('.$rs->fields['id_grado'].')">                            
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
    $sql = "DELETE 
    FROM `colegio`.`grado` 
    WHERE `id_grado`= ?";
    $rs = $con->dosql($sql, array($id));
}*/

public function eliminar($id)
{
    $reg              = new Grado('grado');
    $reg->load("id_grado = {$id}");
    $reg->Delete();
}

/*public function editar($id,$desc, $letra, $numero)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`grado`
                SET descripcion = ?, `letra`= ?, numero = ?
                WHERE `id_grado`= ?";
    $rs = $db->dosql($sql, array($desc,$letra,$numero,$id));
       //var_dump($sql);
  }*/

  public function editar($id,$desc, $letra, $numero)
    {
        $reg              = new Grado('grado');
        $reg->load("id_grado = {$id}");
        $reg->descripcion      = $desc;
         $reg->letra = $letra;
        $reg->numero = $numero;       
        $reg->Save();
        //return $reg->id_grado;
    }

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
  id_grado,descripcion,letra, numero
FROM
  grado
 WHERE `id_grado`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF) 
                   {

                    $res = array( 
                      "id_grado"  => $rs->fields['id_grado'],
                      "descripcion"      => $rs->fields['descripcion'],
                      "letra" => $rs->fields['letra'],
                      "numero" => $rs->fields['numero']
                      );

                    $rs->MoveNext();      
                   } 
                   return $res;

  }

}

?>