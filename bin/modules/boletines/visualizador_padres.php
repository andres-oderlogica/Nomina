<?php
include '../../../core.php';
include_once 'clases/boletin.php';
$cod_estudiante=$_POST['cod_estudiante'];
$periodo=$_POST['periodo'];




$boletin= new boletin();
$user = $boletin->validarPago($cod_estudiante);
if($user == 1)
{
$cod_grado=$boletin->identificar_grado_del_estudiante($cod_estudiante);//var_dump($cod_grado);
$id_estudiantexgrado=$boletin->identificar_id_estudiantexgrado($cod_estudiante,$cod_grado);//var_dump($id_estudiantexgrado);
$materiasOrganizadas=$boletin->buscar_materias_organizadasxgrado($cod_grado,$periodo);

 $tabla = '<table id="myTable2" class="table table-hover table-striped table-bordered table-condensed" cellpadding="0" cellspacing="0" border="1" class="display" >
                        <thead>
                        <tr>
                        <th id="yw9_c0">#</th>
                        <th id="yw9_c2">Materia</th>
                        <th id="yw9_c1">Nota 1</th>
                        <th id="yw9_c1">Nota 2</th>
                        <th id="yw9_c1">Nota 3</th>
                        <th id="yw9_c2">Nota 4</th>
                        <th id="yw9_c2">Nota 5</th>
                        <th id="yw9_c2">Nota 6</th>
                        <th id="yw9_c2">Nota 7</th>
                        <th id="yw9_c2">Nota 8</th>
                        <th id="yw9_c2">30%</th>
                        <th id="yw9_c2">20%</th>
                        <th id="yw9_c2">%50</th>
                      
                                                
                        

                        </tr>
                        </thead>
                        <tbody>';

for ($i=0; $i < count($materiasOrganizadas); $i++) 
{ 
   $tabla.='<tr >  
                            <td>                            
                                '.utf8_encode($materiasOrganizadas[$i]['id_m_o']).'
                            </td>
                            <td>                            
                                '.utf8_encode($materiasOrganizadas[$i]['descripcion']).'
                            </td>';
                            //var_dump($id_estudiantexgrado,$materiasOrganizadas[$i]['id_m_o'],$periodo);
   	$notas=$boletin->listar_notas2($id_estudiantexgrado,$materiasOrganizadas[$i]['id_m_o'],$periodo);
//var_dump($notas);
      		       
   		       

                    
                    $tabla.='<td>                            
          <input class="form-control" id="n1" name="direccion" disabled  type="text" value='.utf8_encode($notas['n1']).' >
                
                            </td>
                            <td>                            
          <input class="form-control" id="n2" name="direccion" disabled  type="text" value='.utf8_encode($notas['n2']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n3" name="direccion" disabled   type="text" value='.utf8_encode($notas['n3']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n4" name="direccion" disabled  type="text" value='.utf8_encode($notas['n4']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n5" name="direccion" disabled  type="text" value='.utf8_encode($notas['n5']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n6" name="direccion" disabled  type="text" value='.utf8_encode($notas['n6']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n7" name="direccion" disabled  type="text" value='.utf8_encode($notas['n7']).'>
                
                            </td>
                            <td>                            
          <input class="form-control" id="n8" name="direccion" disabled  type="text" value='.utf8_encode($notas['n8']).'>
                
                            </td>
                            <td>'.$notas['acumulado'].
                            '</td>
                            <td>                            
          <input class="form-control" id="n9" name="direccion"  disabled type="text" value='.utf8_encode($notas['n9']).'>
                
                            </td>                            
                            
                            <td>'.$notas['acumulado50'].
                            '</td>' ;                                                                               
                            
            

   		   	
   		   	$tabla.= '</tr>';                                     
  
            $notas="";
       

}

 $tabla.="</tbody></table>";

 echo $tabla;
}
else
{
  echo "No ha realizado el pago";
}

?>