<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';
include_once 'data_access.class.php';

User::session_start();
View::start('Clínica WebSalud', 0);
if (isset($_POST['historial'])){
    
    $_SESSION['idPaciente'] = $_POST['id'];
    header("Location: Especialistas/pacienteHistorial.php");
    
}else if(isset($_POST['agregar'])){
    
    $_SESSION['idPaciente'] = $_POST['id'];
    header("Location: Especialistas/addHistorial.php");
     
}else{
    
    $user = User::getLoggedUser();
    echo "<input type='hidden' name='cuenta_user' id='cuenta_user' value='{$user['cuenta']}'>";
    
        $query = "SELECT u.id, u.nombre, u.email, u.poblacion, u.direccion, u.telefono FROM usuarios u, pacientesespecialistas p 
        where u.id = p.idpaciente and p.idespecialista = 
        (SELECT id from usuarios WHERE cuenta = '".$user['cuenta']."')";
        
        $res = DB::execute_sql($query);
        
    //}
    
    $res->setFetchMode(PDO::FETCH_NAMED);
    $datos = $res->fetchAll();

    #----------------------------------------------------------

    
    echo "<img src='logo.png'>";
    
    if (isset($_SESSION['user'])){
        $user = User::getLoggedUser();
        
        if($user['tipo'] == 2){
            LoggedView::navigation(2, 0);
            echo "<form method='POST' id='form_filter'>
                    <label>Filtrar por nombre</label>
                    <input type='text' name='filtro' id='filtro' onkeyup='setTimeout(\"filter()\", 100);' placeholder='Nombre del paciente'>";
                echo"</form>";
                
            echo "<table id='table'>";
                    echo"<tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Población</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>";
                    
                    foreach($datos as $dato){
                    
                        echo "<form method='POST' id='form-tabla'>
                                <tr>
                                <input type='hidden' name='id' value='{$dato['id']}'>
                                    <td>{$dato['nombre']}</td>
                                    <td>{$dato['email']}</td>
                                    <td>{$dato['poblacion']}</td>
                                    <td>{$dato['direccion']}</td>
                                    <td>{$dato['telefono']}</td>
                                    <td><input type='submit' name='agregar' id='field-agregar' value='Agregar visita'>
                                    <input type='submit' name='historial' id='field-historial' value='Ver historial'></td>
                                </tr>
                        </form>";
                    }
            echo "</table>"; 

        }
    }else {
        header("Location: ./index.php");
    }
}
View::footer();

View::end();


?>