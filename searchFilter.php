<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';
include_once 'data_access.class.php';

//View::start('Clínica WebSalud', 0);

if(isset($_GET['text'])){
    $text = $_GET['text'];
    $cuenta = $_GET['cuenta_user'];
        $query = "SELECT u.id, u.nombre, u.email, u.poblacion, u.direccion, u.telefono FROM usuarios u, pacientesespecialistas p 
        where u.id = p.idpaciente and p.idespecialista = 
        (SELECT id from usuarios WHERE cuenta = '".$cuenta."') 
        and u.nombre like :param";
        
        $param = "%". $text ."%";
        $param = array($param);
        $res = DB::execute_sql($query, $param);
        
        $res->setFetchMode(PDO::FETCH_NAMED);
        $datos = $res->fetchAll();
}else{
    $cuenta = $_GET['cuenta_user'];
        $query = "SELECT u.id, u.nombre, u.email, u.poblacion, u.direccion, u.telefono FROM usuarios u, pacientesespecialistas p 
        where u.id = p.idpaciente and p.idespecialista = 
        (SELECT id from usuarios WHERE cuenta = '".$cuenta."')";    
        
        $res = DB::execute_sql($query);
    
    $res->setFetchMode(PDO::FETCH_NAMED);
    $datos = $res->fetchAll();        
}

        $resultado = "<tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Población</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Opciones</th>
                    </tr>";
                    
                    foreach($datos as $dato){
                       $resultado = $resultado.
                        "<form method='POST' id='form-tabla'>
                            <tr id='tr-table'>
                                <input type='hidden' name='id' value='{$dato['id']}'>
                                <td>{$dato['nombre']}</td>
                                <td>{$dato['email']}</td>
                                <td>{$dato['poblacion']}</td>
                                <td>{$dato['direccion']}</td>
                                <td>{$dato['telefono']}</td>
                                <td><a href= 'Especialistas/addHistorial.php'>Agregar</a>
                                <a href= 'Especialistas/pacienteHistorial.php'>Historial</a><td>
                            </tr>
                        </form>";    
                    }
                    
    echo $resultado;
                    