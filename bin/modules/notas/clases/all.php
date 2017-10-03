<?php
include_once 'matricula.php';
$disc       = new regMatricula();

//var_dump($_POST['ids'],$_POST['n'][$i][0]);

for ($i=0; $i < count($_POST['ids']); $i++) { 

$disc->actualizar($_POST['n'][$i][0],$_POST['n'][$i][1],$_POST['n'][$i][2],$_POST['n'][$i][3],$_POST['n'][$i][4],$_POST['n'][$i][5],$_POST['n'][$i][6],$_POST['n'][$i][7],$_POST['n'][$i][8],$_POST['ids'][$i]);

}

		echo json_encode(1);

?>