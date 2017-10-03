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
           $resp=$com->getJornada();
           $result=json_encode($resp);  
           echo $result;
           break;
           case '3':
             $r=$com->getMateriaxgrado();

             $resultado = json_encode($r);
            // var_dump($resultado); 
             echo $resultado;

             break;
         
         default:
           # code...
           break;
       }
	   


	?>