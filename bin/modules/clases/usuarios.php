<?php 
 include '../../../core.php';
 include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Clientes extends ADOdb_Active_Record{}

class classClientes
{


 public function nuevoCliente($nombres, $identificacion, $tipo, $direccion, $telefono, $correo, $estado)
 { 
 
 $cliente = new Clientes('cliente');
 
 $cliente->nombres = $nombres;  
 $cliente->identificacion = $identificacion;  
 $cliente->id_tipo_cliente = $tipo;  
 $cliente->direccion = $direccion; 
 $cliente->telefono = $telefono; 
 $cliente->correo = $correo;
 $cliente->estado = $estado;
 $cliente->save();
 //var_dump($usuario); 
 }


 function tablaClientes($data)
	{
		$db = App::$base;
	  
       $sql = "SELECT 
  `cliente`.`nombres`,
  `cliente`.`identificacion`,
  `tipo_cliente`.`descripcion`,
  `cliente`.`direccion`,
  `cliente`.`telefono`,
  `cliente`.`correo`,
  `cliente`.`id_cliente`,
               \"
              <button type=\'button\' class=\'btn btn-primary btn-sm btn_edit\' data-title=\'Edit\' data-toggle=\'modal\' data-target=\'#myModal\' >
               <span class=\'glyphicon glyphicon-pencil\'></span></button>
               </div>
                \" 
               as borrar,
               \"
              <button type=\'button\' class=\'btn btn-danger btn-sm btn_delete\' data-title=\'Edit\'>
               <span class=\'glyphicon glyphicon-trash\'></span></button>
               </div>
                \"
                 as buttons                    
            FROM
  `tipo_cliente`
  INNER JOIN `cliente` ON (`tipo_cliente`.`id_tipo_cliente` = `cliente`.`id_tipo_cliente`)
            WHERE nombres like lower('%$data%') or identificacion like '%$data%'
            limit 5";

		$rs = $db->dosql($sql, array());
        $tabla = '<table id="example" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">Identificacion</th>
                        <th id="yw9_c1">Nombres</th>
                        <th id="yw9_c2">Direccion</th>
                        <th id="yw9_c3">Telefono</th>
                        <th id="yw9_c4">Correo</th>
                        <th id="yw9_c5">Edit</th>
                        <th id="yw9_c6">Delete</th>
                        </tr>
                        </thead>
                        <tbody>';
		          while (!$rs->EOF) 
                   {
                   	$tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($rs->fields['identificacion']).'
                            </td>
                            <td>                            
                                '.utf8_encode($rs->fields['nombres']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['direccion']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['telefono']).'
                            </td> 
                            <td>                            
                                '.utf8_encode($rs->fields['correo']).'
                            </td> 
                            <td width= "30" onclick="editar('.$rs->fields['id_cliente'].')">                            
                                '.utf8_encode($rs->fields['borrar']).'
                            </td>

                            <td onclick="eliminar('.$rs->fields['id_cliente'].')">                            
                                '.utf8_encode($rs->fields['buttons']).'
                            </td>' ;                                                                               
                            
            $tabla.= '</tr>';                                     
	
	               $rs->MoveNext();	    
                   }  
            
        $tabla.="</tbody></table>";
        return $tabla;
	}

	public function editClientes($nom,$ident,$dir,$tel,$cor,$id)
	{

		$db = App::$base;
        $sql = "UPDATE `inv`.`cliente` 
                SET `nombres`= '$nom', 
                    `identificacion`='$ident', 
                    `direccion`='$dir',
                    `telefono`='$tel',
                    `correo`='$cor'
                WHERE `id_cliente`= $id ";
		$rs = $db->dosql($sql, array());
       var_dump($sql);
	}

	public function deleteClientes($id)
	{
		$db = App::$base;
        $sql = "DELETE FROM `inv`.`cliente` 
                WHERE `id_cliente`=$id ";
		$rs = $db->dosql($sql, array());

	}

	public function buscarClientes($id)
	{
		$db = App::$base;
        $sql = "SELECT 
  `cliente`.`nombres`,
  `cliente`.`identificacion`,
  `tipo_cliente`.`descripcion`,
  `cliente`.`direccion`,
  `cliente`.`telefono`,
  `cliente`.`correo`,
  `cliente`.`id_cliente`
FROM
  `tipo_cliente`
  INNER JOIN `cliente` ON (`tipo_cliente`.`id_tipo_cliente` = `cliente`.`id_tipo_cliente`)
WHERE `id_cliente`= $id ";
		$rs = $db->dosql($sql, array());

		while (!$rs->EOF) 
                   {

                   	$res = array( "id_cliente" => $rs->fields['id_cliente'],
                      "nombres" => $rs->fields['nombres'],
                      "identificacion" => $rs->fields['identificacion'],
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