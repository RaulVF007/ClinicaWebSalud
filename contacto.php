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
    
    echo '<h3>Contacta con nosotros</h3>';

    echo '<ol>
      <h4>Vías de contacto:</h4>
      <li class="li_ol"><p>Email: clinicawebsalud@salud.es</p></li>
      <li class="li_ol"><p>Teléfono: 928000000</p></li>
      <li class="li_ol"><p>Fax: 928111111</p></li>
      <h4>Ubicación:</h4>
      <p>C/ Los Olivos 40 1º A</p>
    </ol>'; 
}

View::footer();

View::end();