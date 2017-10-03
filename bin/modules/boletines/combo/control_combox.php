<?php
include '../../../../core.php';
include 'class_combox.php';
$option  = $_POST['opcion'];
$id = $_POST['valor'];
$com = new combo();      

       switch ($option) {
         case '1':
           $rst=$com->getGrado();
           $res=json_encode($rst);  
           echo $res;
           break;
           case '2':
           $resp=$com->getPeriodo();
           $result=json_encode($resp);  
           echo $result;
           break;
           case '3':
             $r=$com->getDocente();
             $resultado = json_encode($r);
             echo $resultado;
             break;
         
         default:
           # code...
           break;
       }
	   


	?>