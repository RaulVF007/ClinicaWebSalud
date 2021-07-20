<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';
include_once 'data_access.class.php';

$query = "SELECT * FROM usuarios WHERE tipo = 4";

$res = DB::execute_sql($query);
$res->setFetchMode(PDO::FETCH_NAMED);

$datos = $res->fetchAll();

View::start('Clínica WebSalud', 0);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 3){
        LoggedView::navigation(3, 0);
        
        if(isset($_POST['añadir'])){
            $_SESSION['id_user'] = $_POST['id'];
            header("Location: /Auxiliares/formHistorial.php");
        }
        
        echo "<table>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Opciones</th>
                </tr>";
                
                foreach($datos as $dato){
                    echo "<form method='POST'>";
                    echo "<tr>";
                    echo "<input type='hidden' name='id' value='{$dato['id'][0]}'>";
                    echo "<td>{$dato['nombre']}</td>";
                    echo "<td>{$dato['email']}</td>";
                    echo "<td>{$dato['direccion']}</td>";
                    echo "<td>{$dato['telefono']}</td>";
                    echo "<td><input type='submit' value='Añadir' name='añadir'></td>";
                    echo "</tr>";
                    echo "</form>";
                }
        echo "</table>"; 
    }
}else {
    header("Location: ./index.php");
}

View::footer();

View::end();
