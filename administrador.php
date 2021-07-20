<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';
include_once 'data_access.class.php';

$query = "SELECT * FROM usuarios WHERE tipo = 2";

$res = DB::execute_sql($query);
$res->setFetchMode(PDO::FETCH_NAMED);

$datos = $res->fetchAll();

View::start('Clínica WebSalud', 0);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 1){
        LoggedView::navigation(1, 0);
        
        if(isset($_POST['modificar'])){
            $_SESSION['id_user'] = $_POST['id'];
            $_SESSION['action'] = 'modificar';
            header("Location: /Administrador/formEspecialista.php");
        }elseif(isset($_POST['añadir'])){
            $_SESSION['id_user'] = $_POST['id'];
            $_SESSION['action'] = "añadir";
            header("Location: /Administrador/formEspecialista.php");
        }elseif(isset($_POST['borrar'])){
            $_SESSION['id_user'] = $_POST['id'];
            $_SESSION['action'] = "borrar";
            header("Location: /Administrador/formEspecialista.php");
        }
        
        echo "<table>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Especialidad</th>
                    <th>Opciones</th>
                </tr>";
                
                foreach($datos as $dato){
                    echo "<form method='POST'>";
                    echo "<tr>";
                    echo "<input type='hidden' name='id' value='{$dato['id'][0]}'>";
                    echo "<td>{$dato['nombre']}</td>";
                    echo "<td>{$dato['tipo']}</td>";
                    echo "<td>{$dato['email']}</td>";
                    echo "<td>{$dato['direccion']}</td>";
                    echo "<td>{$dato['telefono']}</td>";
                    
                    $query_especialidad = "SELECT * FROM especialistas WHERE idespecialista = '".$dato['id']."'";
                    $res_especialista = DB::execute_sql($query_especialidad);
                    $res_especialista->setFetchMode(PDO::FETCH_NAMED);
                    
                    $datos_especialistas = $res_especialista->fetchAll();                    
                    //echo "<td>{$dato['especialidad']}</td>";
                    echo "<td>";
                    foreach($datos_especialistas as $especialidad){
                        echo "{$especialidad['especialidad']}<br>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<input type='submit' name='añadir' value='Añadir'>";
                    echo "<input type='submit' name='modificar' value='Modificar'>";
                    echo "<input type='submit' name='borrar' value='Borrar'>";
                    echo "</td>";
                    
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
