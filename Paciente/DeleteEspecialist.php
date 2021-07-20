<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

$id = $_GET['key'];
$idespecialista = $_GET['especialista'];
$query = "DELETE FROM pacientesespecialistas WHERE idpaciente =".$id." and idespecialista=".$idespecialista;

$res = DB::execute_sql($query);
?>