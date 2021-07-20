<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud', 1);
User::session_start();
echo "<img src='../logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 4){
        
        LoggedView::navigation(4, 1);
        //$_SESSION['especialista_nuevo'] = $_POST['especialista_nuevo'];
        //$nombre_especialidad = $_SESSION['especialidad'];
        
        $query = "SELECT u.id, u.nombre FROM especialistas e, usuarios u WHERE e.idespecialista = u.id AND e.especialidad = '".$_SESSION['especialidad']."'";
        $res = DB::execute_sql($query);
        $res->setFetchMode(PDO::FETCH_NAMED);
        $datos = $res->fetchAll();
        
        //var_dump($datos);
    ?>
    
        <form action=./savePaciente.php method='POST'>
        <table>
                Nombre del especialista: <select name='id_nuevo'>
                <?php        
                    foreach($datos as $dato){
                ?>      
                        <!--<input type="hidden" name='especialista_nuevo' value=<?php// $dato['id']?>>-->
                        <option value ='<?php echo $dato['id']?>'> <?php echo $dato['nombre']?> </option>
                <?php
                    }
                ?>
                 </select>
            <?php
            echo "
            </table>
            <input type='submit' value='Actualizar especialista'>";  
        }
        echo "</form>";
    }else {
    header("Location: ../index.php");
}

View::footer();

View::end();