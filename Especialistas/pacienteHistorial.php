<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

User::session_start();

    $query = "SELECT h.fechahora, h.asunto, h.descripcion from historial h, usuarios u WHERE
                h.idpaciente = u.id AND  h.idpaciente = ". $_SESSION['idPaciente']."
                ORDER by h.fechahora DESC";
    
    $res = DB::execute_sql($query);
    $res->setFetchMode(PDO::FETCH_NAMED);
    
    $datos = $res->fetchAll();
    #----------------------------------------------------------
    View::start('Clínica WebSalud', 1);
    
    echo "<img src='../logo.png'>";
    
    if (isset($_SESSION['user'])){
        $user = User::getLoggedUser();
        
        if($user['tipo'] == 2){
            LoggedView::navigation(2, 1);
            
            echo "<table>
                    <tr>
                        <th>Fecha y hora</th>
                        <th>Asunto</th>
                        <th>Descripción</th>
                    </tr>";
                   
                    foreach($datos as $dato){
                        echo"<form method='POST'>";
                            echo "<tr>";
                                echo "<td>". date('d-m-Y H:i:s', $dato['fechahora'])."</td>";
                                echo "<td>{$dato['asunto']}</td>";
                                echo "<td>{$dato['descripcion']}</td>";
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
?>