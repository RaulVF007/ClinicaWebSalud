<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud',1);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 3){
        LoggedView::navigation(3, 1);
        
        echo "<form action=./saveHistorial.php method='POST'>
            Fecha: <input type='date' name='fecha' required>
            Hora: <input type='time' name='hora' required>
            Tipo registro: <select  name='tipo' required>
                <option value='1'>Consulta</option>
                <option value='2'>Diagnóstico</option>
                <option value='3'>Tratamiento</option>
                <option value='4'>Seguimiento</option>
                <option value='5'>Resultado prueba</option>
            </select>
            Asunto: <input type='text' name='asunto' required minlength='1' maxlength='32'> 
            Descripción: <input type='text' name='descripcion' required minlength='12' maxlength='5000'>  
            <input type='submit' value='Enviar'>";        
            
        echo "</form>";
    }
    
}else {
    header("Location: ../index.php");
}

View::footer();

View::end();