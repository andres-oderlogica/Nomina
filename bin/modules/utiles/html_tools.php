<?php
 /***********************************************************
 * Herramientas HTML
 *
 * @author     Jimmy Andrés campo Bravo  <info@oderlogica.com>
 * @copyright  1996-2015 Oderlogica - Todos los derechos reservados - http://www.oderlogica.com
 * @license    Este código y sus derivados son propiedad de Oderlogica
 * @version    1.0
 ************************************************************/
 include_once '../../../core.php';

  //*********************************************
  class ControlHTML
  {
    protected $id;
  	protected $class;
  	protected $value;
  	protected $style='';
  	
  	function __construct($id, $class='', $value='')
  	{
  	  $this->id = $id;
  	  $this->class = $class;
  	  $this->value = $value;
  	}

  	function getCSS($name=false)
  	{
  		$css = CssData::render($this->id, $this->class, $this->style, $name);
  		return $css;
  	}
  }
  //*********************************************

 class CssData
 {   
   
   static function joinCad($c1, $c2)
   {
     $c1 = trim($c1);
     $c2 = trim($c2);

     $res = (empty($c2))?$c1:"$c1 $c2";
     return $res;
   }

   static function joinVec($vec)
   {
     $res = '';
     foreach ($vec as $value) {
       $res = self::joinCad($res, $value);
     }
     return $res;
   }

   static function render($id, $class='', $style = '', $name=false)
   {
     $cad_id = ($id != '')?"id = \"$id\"":$id;
     if ($name) $cad_name = "name = \"$id\"";
  	 $cad_class = ($class != '')?"class = \"$class\"":$class;
  	 $cad_style = ($style != '')?"style = \"$style\"":$style;
     $res = self::joinVec(array($cad_id, $cad_name, $cad_class, $style));
  	 // $res = "$cad_id $cad_name $cad_class $style";
  	 return trim($res);
   }
 }
 

 class htmlCombo extends ControlHTML
 {
  
  private $data = array();
  private $selected;

  //********************************************* 
  function __construct($data, $selected=-1, $id='', $class='')
  {
   $this->data = $data;
   $this->selected = $selected;   
   parent::__construct($id, $class);
  }
  //********************************************* 
 function render()
  {
   
   $css = $this->getCSS(true);  // incluir name
   $cad = "<select $css>";
   // var_dump($this->data);
   foreach ($this->data as $key => $value)
    {if ($key == $this->selected)
      $cad.='<option value="'.$key.'" selected>'.$value."</option>\n"; 
     else 
      $cad.='<option value="'.$key.'">'.$value."</option>\n";      
    }
   $cad .= '</select >';
   return $cad; 
  }
  //********************************************* 

 }


 class DbCombo extends ControlHTML
 {
   private $tabla;
   private $campos;
   private $key_field;
   private $value_field;
   private $db;
   private $selected;

 //********************************************* 
 function __construct($tabla, $campos, $id='', $class='', $db = null, $selected=-1 )
 {
   $this->tabla = $tabla;
   $this->campos = $campos;
   $this->db = ($db == null)?App::$base : null;
   $this->selected = $selected;
   $this->key_field = $campos[0];
   $this->value_field = $campos[1];
   parent::__construct($id, $class);
 }
 //********************************************* 
 function render()
  {$sql = "select {$this->key_field}, {$this->value_field} from {$this->tabla} order by {$this->campos[1]} ";
 $rs = $this->db->dosql_raw($sql);
 $css = $this->getCSS(true);  // incluir name
 $cad = "<select $css>";
 while (!$rs->EOF)
  {if ($rs->fields[$this->key_field] == $this->selected)
    $cad.='<option value="'.$rs->fields[$this->key_field]. '" selected>'.$rs->fields[$this->value_field]."</option>\n"; 
   else	
    $cad.='<option value="'.$rs->fields[$this->key_field]. '">'.$rs->fields[$this->value_field]."</option>\n";
	 $rs->MoveNext();
  }
 $cad .= '</select >';
 return $cad; 
  }
 //********************************************* 
 }

   /*"draw": 17,
  "recordsTotal": 57,
  "recordsFiltered": 57,
  "data": [
    {
      "DT_RowId": "row_5",
      "first_name": "Airi",
      "last_name": "Satou",
      "position": "Accountant",
      "office": "Tokyo",
      "start_date": "28th Nov 08",
      "salary": "$162,700"
    },*/
 class TableRecord
 {
   public $recordsTotal;
   public $recordsFiltered;
   public $draw;
   public $data=array();

   function __construct($tot, $fil, $draw)
   {
    $this->recordsTotal = $tot;
    $this->recordsFiltered = $fil;
    $this->draw = $draw;
   }

   function addData($value) // arreglo
   {
     if (isset($value['dt_rowid']))   // Reemplazar llave primaria por correcta, la retorna en minúsculas
        { $value['DT_RowId'] = $value['dt_rowid'];
          unset($value['dt_rowid']);
        }
     $this->data[] = (object) $value;   //arreglo a objeto

   }
 }

 class jsonData
 {
   static function renderAutocomplete($tabla, $id, $value, $label, $termino, $sql='', $db = null)
   {
     if ($db == null) $db = App::$base;
	 // var_dump($db);
	 if ($sql=='')
	  $sql = "select $id, $value, $label from $tabla where $label ilike '%$termino%' order by $label limit 15";
	 // die($sql);

	 $res = array();
     $rs = $db->dosql_raw($sql);
	 while (!$rs->EOF)
	  {
	   $row["id"] = (stripslashes($rs->fields[$id]));
	   $row["value"] = (stripslashes($rs->fields[$value]));
	   $row["label"] = (stripslashes($rs->fields[$label]));
     if (array_key_exists('extra_data', $rs->fields))
        $row["extra_data"] = (stripslashes($rs->fields['extra_data']));
	   array_push($res, $row);
	   $rs->MoveNext();
	 }
	 self::Headers();
   // var_dump($res); die();
	 return json_encode($res);
   }
    
   static function getControls($pk)
    { $edit = '
     <button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" >
     <span class="glyphicon glyphicon-pencil"></span></button>
      ';
     $delete = '
     <button type="button" class="btn btn-danger btn-sm btn_delete" data-title="Delete" >
     <span class="glyphicon glyphicon-trash"></span></button>
     ';
     $res = "<div class=\"row\">$edit $delete</div>";
     return $res;
    }

   static function render_table($sql, $data, $params, $db = null)
   {
   if ($db == null) $db = App::$base;
   // var_dump($db);
   $rs = $db->dosql_raw($sql); 
   $max = $rs->RecordCount();
   $count = $data['length'];  $from = $data['start'];
   $draw = $data['draw'];  $termino = $data['term']; 
   $crud = $data['crud'];   
   $rs = $db->dosql_limit($sql, $count, $from, $params);
   // var_dump($sql);
   $rec = new TableRecord($max, $max, $draw);

   while (!$rs->EOF)
    {
     $record = $rs->FetchRow();   //auto-movenext

     if (!empty($crud))
       $record['accion'] = self::getControls($record['dt_rowid']);
      // var_dump($record); die();
     $rec->addData($record);
    }
   self::Headers();
   return json_encode($rec);
   }

   static function Headers()
		{
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
	  header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT"); 
		header("Cache-Control: no-cache, must-revalidate"); 
		header("Pragma: no-cache");
		header("Content-type: application/json");
		}
 }
  //********************************************* 
  
  class InputHTML extends ControlHTML
   {
    protected $type;
  	

	function __construct($type, $id, $class='', $value='')
	{
	  $this->type = $type;
	  parent::__construct($id, $class, $value);
	}
	
	function render($style = '', $extra='')
  	{ $css = CssData::render($this->id, $this->class, $style);
  	  $value = ($this->value != '')?"value = \"{$this->value}\"":'';
  	  $type = "type = \"{$this->type}\"";
  	  $name = "name = \"{$this->id}\"";
  	  $res = "$type $name $css $value $extra";
  	  $res = "<input $res/>";
  	  
  	  return $res;
  	}
  }
  //********************************************* 
  // Empaqueta get como input hiddens
  class PackRequest   
  {
    
    static function Render($r='P')
    { $res = '';
      $data = ($r == 'P')?$_POST:$_GET;
      foreach ($data as $key => $value) {
          $inp = new InputHTML('hidden', $key, '', $value);
          $res .= $inp->render()."\n";
      }
      return $res;
    }
  }
  //********************************************* 
  class HtmlWidgets
  { private $widgets = array();

    static function get($widget)
    {
      $w['dbcontrols'] = '
       <div id="dbcontrols">
         <input type="button" name="save" id="save" value="Guardar" />
         <input type="button" name="cancel" id="cancel" value="Cancelar" />
         <input type="button" name="new" id="new_record" value="Nuevo" />
       </div>
      ';

      return $w[$widget];
    }

    static function Tag($tag, $value, $id, $class, $crlf=false, $multi_line=false)
    {  $sep = ($crlf)?"\n":'';
       $sep_ml = ($multi_line)?"\n":'';
       
       $css = CssData::render($id, $class);
       if (!empty($css))
         $css = ' ' .$css;

       $res = "<$tag{$css}>{$sep_ml}$value${$sep_ml}</$tag>{$sep}";
       return $res;
    }
  }


  
?>