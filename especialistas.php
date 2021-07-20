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
    
    if (isset($_POST['buscar'])){
 
        $query = "SELECT u.id, u.nombre, u.email, u.poblacion, u.direccion, u.telefono FROM usuarios u, pacientesespecialistas p 
        where u.id = p.idpaciente and p.idespecialista = 
        (SELECT id from usuarios WHERE cuenta = '".$user['cuenta']."') 
        and u.nombre like :param";
        
        $param = "%". $_POST['filtro'] ."%";
        $param = array($param);
        $res = DB::execute_sql($query, $param);
        
    }else{
        $query = "SELECT u.id, u.nombre, u.email, u.poblacion, u.direccion, u.telefono FROM usuarios u, pacientesespecialistas p 
        where u.id = p.idpaciente and p.idespecialista = 
        (SELECT id from usuarios WHERE cuenta = '".$user['cuenta']."')";
        
        $res = DB::execute_sql($query);
        
    }
    
    $res->setFetchMode(PDO::FETCH_NAMED);
    $datos = $res->fetchAll();

    #----------------------------------------------------------

    
    echo "<img src='logo.png'>";
    
    if (isset($_SESSION['user'])){
        $user = User::getLoggedUser();
        
        if($user['tipo'] == 2){
            LoggedView::navigation(2, 0);
            echo "<form method='POST'>
                    <label>Filtrar por nombre</label>
                    <input type='text' name='filtro' placeholder='Nombre del paciente'>
                    <input type='submit' name='buscar' value='Buscar'>
                </form>";
                
            echo "<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Población</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>";
                   
                    foreach($datos as $dato){
                        echo"<form method='POST'>";
                            echo "<tr>";
                                echo "<input type='hidden' name='id' value='{$dato['id']}'>";
                                echo "<td>{$dato['nombre']}</td>";
                                echo "<td>{$dato['email']}</td>";
                                echo "<td>{$dato['poblacion']}</td>";
                                echo "<td>{$dato['direccion']}</td>";
                                echo "<td>{$dato['telefono']}</td>";
                                echo "<td><input type='submit' name='agregar' value='Agregar visita'></td>";
                                echo "<td><input type='submit' name='historial' value='Ver historial'></td>";
                            echo "</tr>";
                        echo "</form>";
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