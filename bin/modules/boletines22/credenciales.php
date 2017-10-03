<?php
include '../../../core.php';
include_once 'clases/boletin.php';

$cod_estudiante=$_POST['id_estudiante'];
$user = $_POST['user'];
//var_dump($cod_estudiante,$user);
$boletin= new boletin();
$idEstudiante = $boletin->validarUsuarioEstudiante($cod_estudiante, $user);

if($idEstudiante==null)
{
   echo json_encode(false);
}
else
{
	echo json_encode(true);

}
?>
