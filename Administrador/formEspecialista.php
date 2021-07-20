<?php
include_once '../presentation.class.php';
include_once '../business.class.php';
include_once '../logged.presentation.class.php';
include_once '../data_access.class.php';

View::start('Clínica WebSalud', 1);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 1){
        LoggedView::navigation(1, 1);
        $query = "SELECT * FROM usuarios WHERE id ='".$_SESSION['id_user']."' ";
        $res = DB::execute_sql($query);
        $res->setFetchMode(PDO::FETCH_NAMED);
        
        $data = $res->fetchAll();

        foreach($data as $d)
        echo "<form action=./saveEspecialista.php method='POST'>
            Nombre: <input type='text' name='nombre' value='".$d['nombre']."' disabled> <br/>
            Tipo: <input type='number' name='tipo' value='".$d['tipo']."' disabled> 
            Email: <input type='text' name='email' value='".$d['email']."' disabled>
            Dirección: <input type='text' name='direccion' value='".$d['direccion']."' disabled> 
            Teléfono: <input type='number' name='telefono' value='".$d['telefono']."' disabled>  ";
            
            $query_especialidad = "SELECT * FROM especialistas WHERE idespecialista = '".$d['id']."'";
            $res_especialista = DB::execute_sql($query_especialidad);
            $res_especialista->setFetchMode(PDO::FETCH_NAMED);
                    
            $datos_especialistas = $res_especialista->fetchAll();                    
            
            if($_SESSION['action'] == 'modificar'){
                echo "Especialidad: <select name='especialidad'>";
                
                foreach($datos_especialistas as $especialidad){
                    echo "<option value=".$especialidad['especialidad'].">".$especialidad['especialidad']."</option>";
                    
                }
                echo "</select>";
                echo "<input type='text' name='newEspecialidad'>";
            }else if($_SESSION['action'] == "añadir"){
                echo "Especialidad: <input type='text' name='especialidad'>";
            }else if($_SESSION['action'] == "borrar"){
                echo "Especialidad: <select name='especialidad'>";
                
                foreach($datos_especialistas as $especialidad){
                    echo "<option value=".$especialidad['especialidad'].">".$especialidad['especialidad']."</option>";
                    
                }
                echo "</select>";
            }
            
            echo "<input type='submit' value='Enviar'>";        
        echo "</form>";
    }
    
}else {
    header("Location: ../index.php");
}

View::footer();

View::end();