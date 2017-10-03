<?php
include_once 'matricula.php';
$semestre  = new regMatricula();
$grados=$semestre->getGrado();
//var_dump($grados);
for ($i=0; $i < count($grados) ; $i++) { 
	
	$estudiantes=$semestre->listMatriculados2($grados[$i]);
//var_dump($estudiantes);
	for ($j=0; $j <count($estudiantes) ; $j++) { 
	$semestre->crear_plantilla_de_notas2($estudiantes[$j]);
	}
    


}


?>