<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud', 1);

echo "<img src='logo.png'>";

        //var_dump($_SESSION['user_data_logged']['id'][0]);
        //var_dump($_POST['tipo']);
        $query_insert_especialista = "INSERT INTO historial (idpaciente, fechahora, idcreador, tipo, asunto, descripcion) VALUES (?, ?, ?, ?, ?, ?)";
        
        $param = array($_SESSION['id_user'], strtotime($_POST['fecha'].$_POST['hora']), $_SESSION['user_data_logged']['id'][0], $_POST['tipo'], $_POST['asunto'], $_POST['descripcion']);
        $res = DB::execute_sql($query_insert_especialista, $param);
        
        var_dump($res);
        
        if($res != false){
            echo "<h3> Al especialista " .$_POST['nombre']. " se le modificó / añadió una especialidad.</h3>";
            header("Location: ../auxiliares.php");
            
        }else{
            echo "<h3> No se pudo insertar</h3>";
            //header("Location: ../auxiliares.php");
        }        
        

View::footer();

View::end();        