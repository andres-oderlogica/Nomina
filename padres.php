
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>    
   
  <title>Padres</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
   <script src="lib/js/jquery.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
    <script src="bin/modules/plantilla2/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <script src="lib/js/jquery.dataTables.min.js?v=<?php echo str_replace('.', '', microtime(true)); ?>"></script>
   <!--<script src="lib/bootstrap-3.3.2/js/bootstrap.min.js"></script>-->
   <script src="lib/bootbox.min.js"></script>
   <script src="lib/bootstrap.min.js" data-semver="3.1.1" data-require="bootstrap"></script>
  <script src='padres.js?v=<?php echo str_replace('.', '', microtime(true)); ?>'></script>
 <!-- <script src='js/modal_editar_docente.js?v=<?php// echo str_replace('.', '', microtime(true)); ?>'></script>-->
  <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="bin/modules/plantilla2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="bin/modules/plantilla2/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="bin/modules/plantilla2/dist/css/skins/skin-blue.min.css">
  <script src="bin/modules/plantilla2/dist/js/app.min.js"></script>
  
  <style>
            
         
            .dataTables_filter label{
                display:block !important;
            }
            #myTable_paginate{
                text-align: -webkit-center;
            }
            #myTable2_paginate{
                text-align: -webkit-center;
                float: right;
                 margin: 0;
            }
            #myTable_info{
                font-weight: bold;
            }
            #myTable2_info{
                font-weight: bold;
            }
            #boletin{
  background-image:url(boletin.png);
  background-size:500% 500%;
}
          /*  .panel-body {
            height: 500px;
            }*/
   
        </style>
   </head>
<body class="hold-transition skin-blue sidebar-mini">
    

  <div class="container-fluid">
    <br><br>
    <input type="hidden" id="id_estudiante" value="<?php echo $_GET['sr'];?>">
    <input type="hidden" id="user" value="<?php echo $_GET['tt'];?>">
             <div class="col-md-12">
<div class="panel panel-primary">
                    <div class="panel-heading">Visualizador de Notas por Materia y Boletines</div>
                      <div class="panel-body">
              <div class="col-md-2">
<a href="bin/modules/boletines/generador_externo_por_estudiante.php?id_estudiante=<?php echo $_GET['sr'];?>&user=<?php echo $_GET['tt'];?>" target="_blank" ><img src="boletin2.png"></a>
              </div>
              <div class="col-md-2">
<a href="bin/modules/notas/visualizador_padres.php?id_estudiante=<?php echo $_GET['sr'];?>" target="_blank"><img src="notas.png"></a>
              </div>

              <div class="col-md-2">
<a href="bin/modules/correos/envio_padres.php?id_estudiante=<?php echo $_GET['sr'];?>" target="_blank"><img src="correo.jpg" width="150px" height="134px"></a>
              </div>
                              
</div>
                  </div>
              </div>   <!--fin 12 -->
      
      <button type="button" class="btn btn-primary btn-sm btn_edit" data-title="Edit" data-toggle="modal" id="salir"><span class="glyphicon glyphicon-minus-sign"></span>Salir</button>

           

        
  </div>





</body>
</html>


