<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';

View::start('Clínica WebSalud', 0);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    
    if($user['tipo'] == 1){
        LoggedView::navigation(1, 0);
    }else if($user['tipo'] == 2){
        LoggedView::navigation(2, 0);
        
    }else if($user['tipo'] == 3){
        LoggedView::navigation(3, 0);
        
    }else if($user['tipo'] == 4){
        LoggedView::navigation(4, 0);
        
    }
}else {
    View::navigation();
    
    echo '<h3>Especialidades</h3>';

    echo '<table>
              <tr>
                <th>Especialidad</th>
                <th>Descripción</th>
                <th>Especialistas disponibles</th>
              </tr>
        
              <tr>
                <td><a href="./cardiologia.php">Cardiología</a></td>
                <td>Es la disciplina médica encargada de la prevención, diagnóstico y el
                tratamiento de enfermedades cardiovasculares</td>
                <td>4</td>
              </tr>
        
              <tr>
                <td><a href="./Especialidad/neumologia.php">Neumología</a></td>
                <td>Es la especialidad que se centra en la prevención, diagnóstico y
                tratamiento de las enfermedades relacionadas con el aparato respiratorio
              y de manera más especfífica, los pulmones, el mediastino y la pleura.</td>
              <td>3</td>
              </tr>
        
              <tr>
                <td><a href="./Especialidad/neurologia.php">Neurología</a></td>
                <td>E sla especialidad que estudia la estructura, función y desarrollo del
                sistema nervioso, utilizando todas las técnias clínicas e instrumentales de
              estudio, diagnóstico y tratamiento actuales.</td>
              <td>5</td>
              </tr>
            </table>'; 
}

View::footer();

View::end();