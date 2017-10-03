<?php

include '../../../core.php';
include_once Config::$home_bin.Config::$ds.'db'.Config::$ds.'active_table.php'; 
 class Estudiante extends ADOdb_Active_Record{}

class importProducts
{

    private $log = array();
    private $id_factura;
    private $id_plan;
    private $id_carga;

    function __construct()
    {
      /*  $this->db       = App::$base;
        $this->id_carga = $id_carga;*/
         $this->db = App::$base;
    }

    //*************************************************

    function saveFactura($data)
    {
       // $cab = atable::Make('tbl_factura');
        $cab              = new Estudiante('estudiante');
        $cab->primer_apellido             = $data[0];
        $cab->segundo_apellido            = $data[1];
        $cab->primer_nombre               = $data[2];
        $cab->segundo_nombre              = $data[3];
       
        $cab->Save();
       // $this->id_factura        = $cab->id_factura;
    }

   

    function save_log()
    {
        $date = date('Y-m-d H-i-s');
        file_put_contents("./error_log ($date).txt", $this->log);
    }

    //*************************************************
    function log($cad, $crlf = "\r\n")
    {
        $this->log[] = $cad . $crlf;
    }

    /* function find($tabla, $datos, $desc, $comp)
      {
      $sql = "select $desc from $tabla where $comp = ? ";
      $rs = $this->db->dosql($sql, array($datos));

      //var_dump($rs->fields[$desc]);
      if($rs)
      {
      return $rs->fields[$desc];}
      else{
      return -1;}
      } */

//*************************************************
    function load_productos()  // [
    {
         $lines = @file("\\var\\www\\html\\sistema\\bin\\modules\\load\\colegio.csv");
        //$lines = @file("$ruta");  // leer archivo
        if (is_null($lines) || ($lines === FALSE))
        {
            throw new Exception('Tabla null');
        }
        else
        {
            foreach ($lines as $line_num => $line)
            {
                $datos = explode(";", $line);
                 echo'<pre>';  
                foreach ($datos as $id => $temp)
                {
                    $datos[$id] = trim($temp);
                    //var_dump(($datos));
                }
               // var_dump(($datos[0]));
              echo'</pre>';

               var_dump($datos);
                   $this->saveFactura($datos);
              

            }
        }



        /*   foreach ($lines as $line_num => $line) 
          {
          $datos = explode("|", $line);  // embalaje marca presentacion descripcion
          var_dump(($datos));



          $new_line['id_ubicacion'] = $datos[0];


          if(empty(trim($datos[1]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('embalaje', $datos[1], 'id_embalaje', 'descripcion');
          if ($id == -1)
          $id = $this->db->Insert('embalaje', array('descripcion'=>$data[0]));
          }
          $new_line['id_embalaje'] = $id;




          if(empty(trim($datos[2]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('tipo_articulo', $datos[2], 'id_tipoarticulo', 'descripcion');
          if ($id == -1)
          $id = $this->db->Insert('tipo_articulo', array('descripcion'=>$data[0]));
          }
          $new_line['id_tipoarticulo'] = $id;


          if(empty(trim($datos[3]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('marca', $datos[3], 'id_marca', 'descripcion');
          if ($id == -1)
          $id = $this->db->Insert('marca', array('descripcion'=>$data[0]));
          }
          $new_line['id_marca'] = $id;



          $new_line['especificacion'] = $datos[4];
          $new_line['presentacion_cantidad_n1'] = $datos[5];


          if(empty(trim($datos[6]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('presentacion', $datos[6], 'id_presentacion', 'descripcion');
          if ($id == -1)
          $id = $this->db->Insert('presentacion', array('descripcion'=>$data[0]));
          }
          $new_line['id_presentacion_n1'] = $id;




          $new_line['presentacion_cantidad_n2'] = $datos[7];

          if(empty(trim($datos[8]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('presentacion', $datos[8], 'id_presentacion', 'descripcion');

          $new_line['id_presentacion_n2'] = $id;
          }


          $new_line['presentacion_cantidad_n3'] = $datos[9];

          if(empty(trim($datos[10]))) {
          $id = 'NULL';}
          else
          {
          $id = $this->find('presentacion', $datos[10], 'id_presentacion', 'descripcion');

          $new_line['id_presentacion_n3'] = $id;

          }
          $new_line['id_padre'] = $datos[11];

          $new_line['porcentaje_iva'] = $datos[12];
          $new_line['tar_1'] = $datos[13];

          $new_line['peso'] = $datos[14];




          try{
          $this->db->Insert('articulos', $new_line);
          }
          catch(Exception $e){

          }

          } */
        $this->save_log();
    }

}

?> 