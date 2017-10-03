<?php
include '../../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Docente extends ADOdb_Active_Record{}
class regDocente
{

public function reg_docente($identificacion,$nombre_completo, $direccion, $telefono, $correo)
    {
        $reg              = new Docente('docente');
        $reg->identificacion      = $identificacion;
        $reg->nombre_completo = $nombre_completo;
        $reg->direccion = $direccion;
        $reg->telefono = $telefono;
        $reg->correo = $correo;
        $reg->Save();
        return $reg->id_docente;
    }


public function listDocente()
{
	$con = App::$base;
    $sql = "SELECT 
			  id_docente,
        identificacion,
			  nombre_completo,
        direccion,
        telefono,
        user_email                 
            FROM
            `docente`
            WHERE
            cod_perfil = 1
            order by 
            nombre_completo ASC
            ";

		$rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Identificacion</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c3">Direccion</th>
                        <th id="yw9_c4">Telefono</th>
                        <th id="yw9_c5">Correo</th>
                       
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
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['direccion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['telefono']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['user_email']).'
                            </td> 
                                                    
                           ' ;                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}

/*public function listDocente()
{
  $con = App::$base;
    $sql = "SELECT 
        id_docente,
        identificacion,
        nombre_completo,
        direccion,
        telefono,
        user_email,        
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
            `docente`
            order by 
            nombre_completo ASC
            ";

    $rs = $con->dosql($sql, array());
        $tabla = '<table id="myTable" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c1">Identificacion</th>
                        <th id="yw9_c2">Nombres y Apellidos</th>
                        <th id="yw9_c3">Direccion</th>
                        <th id="yw9_c4">Telefono</th>
                        <th id="yw9_c5">Correo</th>
                        <th id="yw9_c6">Editar</th>
                        <th id="yw9_c7">Eliminar</th>
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
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombre_completo']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['direccion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['telefono']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['user_email']).'
                            </td> 
                                                    
                            <td width= "30" onclick="editar('.$rs->fields['id_docente'].')">                            
                                '.utf8_encode($rs->fields['editar']).'
                            </td>

                            <td width= "30" onclick="eliminar('.$rs->fields['id_docente'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
  
                 $rs->MoveNext();     
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;

}*/

/*public function eliminar($id)
{
    $con = App::$base;
    $sql = "DELETE 
    FROM `colegio`.`docente` 
    WHERE `id_docente`= ?";
    $rs = $con->dosql($sql, array($id));
}*/

public function eliminar($id)
{
    $reg              = new Docente('docente');
    $reg->load("id_docente = {$id}");
    $reg->Delete();
}

/*public function editar($id,$identificacion, $nombre_completo, $direccion, $telefono, $correo)
  {

        $db = App::$base;
        $sql = "UPDATE `colegio`.`docente`
                SET identificacion = ?, nombre_completo = ?, direccion = ?, telefono = ?, correo  = ?
                WHERE `id_docente`= ?";
    $rs = $db->dosql($sql, array($identificacion,$nombre_completo,$direccion, $telefono, $correo,$id));
      // var_dump($rs);
  }*/

  public function editar($id,$identificacion, $nombre_completo, $direccion, $telefono, $correo)
    {
        $reg              = new Docente('docente');
        $reg->load("id_docente = {$id}");
        $reg->identificacion      = $identificacion;
        $reg->nombre_completo = $nombre_completo;
        $reg->direccion = $direccion;
        $reg->telefono = $telefono;
        $reg->correo = $correo;
        $reg->Save();
       // return $reg->id_docente;
    }

  public function buscar($id)
  {
    $db = App::$base;
        $sql = "SELECT 
                id_docente, 
                identificacion, 
                nombre_completo,
                direccion,
                telefono,
                correo
              FROM
                docente
               WHERE `id_docente`= ?";
    $rs = $db->dosql($sql, array($id));

    while (!$rs->EOF) 
                   {

                    $res = array( 
                      "id_docente"  => $rs->fields['id_docente'],
                      "identificacion"      => $rs->fields['identificacion'],
                      "nombre_completo" => $rs->fields['nombre_completo'],
                      "direccion" => $rs->fields['direccion'],
                      "telefono" => $rs->fields['telefono'],
                      "correo" => $rs->fields['correo']
                      );

                    $rs->MoveNext();      
                   } 
                   return $res;

  }

}

?>