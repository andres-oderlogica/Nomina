<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
        ?>

<!DOCTYPE html>
<html>
<head><title>Registrar Productos</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../../lib/css/general.css"> 
  <link rel="stylesheet" type="text/css" href="../../../lib/bootstrap/css/bootstrap.css"> 
	<script src="../../../lib/jquery/jquery-2.2.3.min.js"></script>
  <script src='js/productos.js'></script>
  <script src='js/tabla.js'></script>
  <script src='js/modalEditarProductos.js'></script>
  <script src='js/validar.js'></script>

     <link rel="stylesheet" href="../../../lib/menu/dist/css/AdminLTE.min.css">
     <link rel="stylesheet" href="../../../lib/menu/dist/css/skins/_all-skins.min.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/iCheck/flat/blue.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/datepicker/datepicker3.css">
     <link rel="stylesheet" href="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   
     <script src="../../../lib/jquery-ui.min.js"></script>
     <script src="../../../lib/menu/plugins/knob/jquery.knob.js"></script>
   
     <script src="../../../lib/menu/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
     <script src="../../../lib/menu/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <script src="../../../lib/menu/plugins/fastclick/fastclick.js"></script>
     <script src="../../../lib/menu/dist/js/app.min.js"></script>
     <script src="../../../lib/menu/dist/js/demo.js"></script>
     <link rel="stylesheet" href="../../../lib/css/awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../lib/css/ionicons.min.css">
  <script src="../../../lib/bootbox.min.js"></script>
  <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
<link type="text/css" href="../../../lib/datatable/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" language="javascript" src="../../../lib/datatable/js/jquery.dataTables.js"></script>


</head>
<body>


<?php
include '../../../plantilla/plantilla1.php';
?> 



<div class="panel panel-default">
   <div class="panel-heading">
     <h3 class="panel-title">Registrar Productos</h3>
  </div>
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
  
   <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="codigo">
       Codigo
      </label>
      <input class="form-control" id="codigo" name="codigo" type="text"/>
     </div>
         </div>
 <div class="col-md-4">
     <div class="form-group ">
      <label class="control-label " for="descripcion">
       Descripcion
      </label>
      <input class="form-control" id="descripcion" name="descripcion" type="text"/>
     </div>
     </div>

      <div class="col-md-2">
     <div class="form-group ">
      <label class="control-label " for="precio">
       Precio
      </label>
      <input class="form-control" id="precio" name="precio" value="0" type="text"/>
     </div>
      </div>

     <div class="col-md-1"> 
     <div class="form-group ">
      <label class="control-label " for="existencias">
       Existencias
      </label>
      <input class="form-control" id="existencias" name="existencias" value="1" type="text"/>
     </div>
     </div>

     <div class="col-md-1"> 
     <div class="form-group ">
      <label class="control-label " for="iva">
       P. Iva
      </label>
      <input class="form-control" id="iva" name="iva" value="0" type="text"/>
     </div>
     </div>

   <!--  <div class="col-md-3"> 
     <div class="form-group ">
      <label class="control-label " for="estado">
       Estado
      </label>
      <select class="select form-control" id="estado" name="estado">
       <option value="1">
        Activo
       </option>
       <option value="2">
        Inactivo
       </option>
      </select>
      <input type="hidden" id="id_estado" value="1">
     </div>
     </div>-->

     <div class="col-md-1"> 
     <div class="form-group">
      <div>
       <button class="btn btn-primary " id= "save" name="save" type="submit">
        Guardar
       </button>
      </div>
      </div>
     </div>
 
 
  </div>
 </div>
</div>
</div>
<div class="panel panel-default">
   <div class="panel-heading clearfix">
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;"></h4>
                <div class="input-group">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar producto">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                      <!--  <button class="btn btn-primary"><i class="glyphicon glyphicon-wrench"></i></button>-->
                    </div>
                </div>
        </div></div>


<div id="contenido"></div>
</div>


<?php
include '../../../plantilla/footer.php';
?>
<?php
include 'modal_editarProductos.php';
?>

</body>
</html>


