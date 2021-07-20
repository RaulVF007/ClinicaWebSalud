<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

User::session_start();
$user = User::getLoggedUser();
echo "<img src='../logo.png'>";

if(isset($_POST['enviar'])){
    
        
    $query_insert = "INSERT INTO 
        historial (idpaciente, fechahora, idcreador, tipo, asunto, descripcion)
        VALUES (?, ?, ?, ?, ?, ?)";
        
    $param = array(
        $_SESSION['idPaciente'],
        strtotime($_POST['fecha'].$_POST['hora']),
        $_POST['tipoCreador'],
        $_POST['tipo'],
        $_POST['asunto'],
        $_POST['descripcion']);
    $res = DB::execute_sql($query_insert, $param);
    
    
    if($res != false){
        header("Location: ../especialistas.php");
            
    }else{
        
        echo "<h3> No se pudo insertar</h3>";
    }    
}else{
    View::start('Clínica WebSalud', 1);
    
    if (isset($_SESSION['user'])){          
            
        if($user['tipo'] == 2){
            LoggedView::navigation(2, 1);
            echo "<form onsubmit=\"return validateHistoryEntry();\" method=\"post\" id=\"formulario\">
                <label>Fecha</label>
                    <input type='date' name='fecha' required><br>
                <label>Hora</label>
                    <input type='time' name='hora'><br>
                    <input type='hidden' name='tipoCreador' value='".$user['id']."'><br>
                <label>Tipo de registro</label>
                    <select  name='tipo' required>
                        <option value='1'>Consulta</option>
                        <option value='2'>Diagnóstico</option>
                        <option value='3'>Tratamiento</option>
                        <option value='4'>Seguimiento</option>
                        <option value='5'>Resultado prueba</option>
                    </select><br>
                <label>Asunto</label>    
                    <input type='text' name='asunto' id='asunto' minlength='1' maxlength='32'><br>
                <label>Descripción</label>
                    <textarea name='descripcion' id='descripcion' maxlength='5000' minlength='12' placeholder='Escribe aqui todos los detalles'></textarea><br>  
                    <input type='submit' name='enviar' value='Enviar'>
                    <input type='reset' value='Borrar'>
            </form>";   
            echo "<p id='error' class='error'></p>";
            echo "<p id='error2' class='error'></p>";
        } 
    }
}       
echo '<script src="../scripts.js"></script>';
View::footer();

View::end(); 
?>