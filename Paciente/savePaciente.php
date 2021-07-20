<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud', 1);
User::session_start();
echo "<img src='logo.png'>";

        $id_user = User::getLoggedUser();
        //var_dump($_POST['id_nuevo']);
        //$query_update = "UPDATE pacientesespecialistas SET idespecialista = ".$_POST['especialista_nuevo']." WHERE id = (SELECT id FROM pacientesespecialistas WHERE idpaciente = ".$id_user['id']." AND idespecialista = ".$_SESSION['id_especialista'].")";
        $query_update = "UPDATE pacientesespecialistas SET idespecialista = ".$_POST['id_nuevo']." WHERE idpaciente = ".$id_user['id']." AND idespecialista = ".$_SESSION['id_especialista']."";

        $res = DB::execute_sql($query_update);
        //var_dump($res);
        
        if($res != false){
            //echo "<h3>El especialista " .$_POST['nombre']. " elegido ha sido modificado junto con sus respectivos datos.</h3>";
            header("Location: ../paciente.php");
            
        }else{
            echo "<h3> No se pudo insertar</h3>";
        }        
        

View::footer();

View::end();        