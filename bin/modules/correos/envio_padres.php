<?php  
  $active_1="";
  $active_2="";
  $active_3="";
  $active_4="";  
  $title="Correos";
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
  <script src='js/envioPadres.js'></script>
  <!--<script src='js/visualizador.js'></script>-->
  <script src='js/modal_correo.js'></script>
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
            #myTable2_paginate{
                text-align: -webkit-center;
            }
            #myTable_info{
                font-weight: bold;
            }
            #myTable2_info{
                font-weight: bold;
            }
            
        </style>
   </head>
<body>
  

  <div class="container-fluid">
    <input type="hidden" id="cod_estudiante" value="<?php echo $_GET['id_estudiante'];?>">
    <br><br>

             <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Docentes</div>
                      <div class="panel-body">

                                       

                      <div id="ver_cargas"></div>

                      </div>

                </div>

              </div>
  </div>



<?php
include 'modal_correo.php';
?>

</body>
</html>


