<?php
session_start();
  if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
    exit;
        }
  
  $active_facturas="active";
  $active_productos="";
  $active_clientes="";
  $active_usuarios="";  
  $title="Discapacidad";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   <?php include("../plantilla/head.php");?>
   <script src="../../../lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <script src="../../../lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="../../../lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="../../../lib/bootbox.min.js"></script>
   <script src="../../../lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='js/discapacidad.js'></script>
  <script src='js/modal_editar_disc.js'></script>
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
 <!-- <script src='js/tabla.js'></script>
  <script src='js/modalEditarClientes.js'></script>
  <script src='js/validar.js'></script>-->
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
            .panel-body {
            height: 500px;
            }
        </style>
   </head>
<body>
   <?php
     include '../plantilla/navbar.php';
  ?> 
<div class="container-fluid">
             <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Registrar Discapacidad</div>
                    <div class="panel-body">
                        <form id="form_discapacidad" action="clases/controldiscapacidad.php">
                            <div class="form form-group col-md-12">
                                <input class="form-control" required="true" id="descripcion" name="descripcion" placeholder="Digita la discapacidad" type="text" >
                                <input id="opcion" name="opcion" value="1" type="hidden" >
                                
                            </div>                         
                            <div class="form form-group col-md-12">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
               <div class="col-md-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">Listado</div>
                    <div class="panel-body">
                        <div id="ver_cargas"></div>
                    </div>
                </div>
            </div>
</div>

<?php
include 'modal_editar_disc.php';
?>

</body>
</html>


