<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   <?php //include("../plantilla/head.php");?>
   <title>Materias</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script> 
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/materia.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
  <script src='js/modal_editar_materia.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />

   <link rel="stylesheet" href="../plantilla2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../plantilla2/dist/css/skins/skin-blue.min.css">
  <script src="../plantilla2/dist/js/app.min.js"></script>

  <style>
            
         
            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable_info{
                font-weight: bold;
            }
            
        </style>
   </head>
<body class="hold-transition skin-blue sidebar-mini">
   <?php
     include '../plantilla2/starter.php';
  ?> 
<div class="container-fluid">
             <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Registrar Materias</div>
                    <div class="panel-body">
                        <form id="form_materia" action="clases/control_materia.php">
                            <div class="col-md-4">
                              <input class="form-control" id="codigo" name="codigo" placeholder="Digita el codigo" type="text" ><br>
                                </div>
                                <div class="col-md-4">
                                <input class="form-control" required="true" id="descripcion" name="descripcion" placeholder="Digita la Materia" type="text" ><br>
                                 </div>                              
                               <!-- <select id="estado" name="estado" class="form-control">
                                <option value="Activa" selected>Activa</option>
                                <option value="Inactiva">Inactiva</option>
                                </select>-->
                                                    
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
               <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Listado</div>
                    <div class="panel-body">
                        <div id="ver_cargas"></div>
                    </div>
                </div>
            </div>
</div>

<?php
include 'modal_editar_materia.php';
?>
<?php
     //include '../plantilla/navbar.php';
   include '../plantilla2/fin.php';
  ?>

</body>
</html>


