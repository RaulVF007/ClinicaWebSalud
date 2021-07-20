<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';
include_once 'data_access.class.php';

View::start('Clínica WebSalud', 0);
User::session_start();
echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 4){
        LoggedView::navigation(4, 0);
        
        if(isset($_POST['cambiar'])){
            $_SESSION['id_especialista'] = $_POST['id_especialista'];
            $_SESSION['especialidad'] = $_POST['especialidad'];
            header("Location: /Paciente/formPaciente.php");
        }
        
        $id = $user['id'];
        $query = "SELECT e.especialidad, u.nombre, u.email, u.telefono, u.id 
        FROM especialistas e, usuarios u, pacientesespecialistas p 
        WHERE p.idespecialista = u.id AND e.idespecialista = u.id AND p.idpaciente = ".$id;

        $res = DB::execute_sql($query);
        $res->setFetchMode(PDO::FETCH_NAMED);

        $datos = $res->fetchAll();
        
        echo "<table>
            <tr>
                <th>Especialidad</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Opciones</th>
            </tr>";
            
        foreach($datos as $dato){
            
            echo"<form method='POST'>";
            echo "<input type= 'hidden' name = 'id_especialista' value = '{$dato['id']}'>";
            echo "<td>{$dato['especialidad']}</td>";
            echo "<input type= 'hidden' name = 'especialidad' value = '{$dato['especialidad']}'>";
            echo "<td>{$dato['nombre']}</td>";
            echo "<td>{$dato['email']}</td>";
            echo "<td>{$dato['telefono']}</td>";
            echo "<td><input type='submit' value='Seleccionar o cambiar especialista' name='cambiar'></td>";
            echo "</tr>";
            echo "</form>";
        }
        echo "</table>"; 
        
        $_SESSION['all_users'] = $datos;
    }
}else {
    header("Location: ./index.php");
}

View::footer();

View::end();
