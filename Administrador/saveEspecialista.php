<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud', 1);

echo "<img src='logo.png'>";


        //var_dump($_SESSION['id_user']);
        $query_update_especialista = "UPDATE especialistas SET especialidad = '".$_POST['newEspecialidad']."' where idespecialista = '".$_SESSION['id_user']."' AND especialidad = '".$_POST['especialidad']."'";
        $query_insert_especialista = "INSERT INTO especialistas (idespecialista, especialidad) VALUES (?, ?)";
        $query_delete_especialista = "DELETE FROM especialistas WHERE especialidad = '".$_POST['especialidad']."'";
        
        if($_SESSION['action'] == "añadir"){
            $param = array($_SESSION['id_user'], $_POST['especialidad']);
            $res = DB::execute_sql($query_insert_especialista, $param);
            
            if($res != false){
                echo "<h3> Al especialista " .$_POST['nombre']. " se le añadió una especialidad.</h3>";
                header("Location: ../administrador.php");
            }            
        }elseif($_SESSION['action'] == "modificar"){
            $res = DB::execute_sql($query_update_especialista);
            
            if($res != false){
                echo "<h3> Al especialista " .$_POST['nombre']. " se le modificó una especialidad.</h3>";
                header("Location: ../administrador.php");
            }
        }elseif($_SESSION['action'] == "borrar"){
            $res = DB::execute_sql($query_delete_especialista);
            
            if($res != false){
                echo "<h3> Al especialista " .$_POST['nombre']. " se le eliminó una especialidad.</h3>";
                header("Location: ../administrador.php");
            }            
        }else{
            header("Location: ../administrador.php");
        }        
        

View::footer();

View::end();        