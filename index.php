<?php
include_once 'presentation.class.php';
include_once 'business.class.php';
include_once 'logged.presentation.class.php';

View::start('Clínica WebSalud', 0);

echo "<img src='logo.png'>";

if (isset($_SESSION['user'])){
    $user = User::getLoggedUser();
    $_SESSION['user_data_logged'] = $user;
    
    
    if($user['tipo'] == 1){
        LoggedView::navigation(1, 0);
        
    }else if($user['tipo'] == 2){
        LoggedView::navigation(2, 0);
        
    }else if($user['tipo'] == 3){
        LoggedView::navigation(3, 0);
        
    }else if($user['tipo'] == 4){
        LoggedView::navigation(4, 0);
        
    }
    echo "<h3> Bienvenido ".$user['nombre'] ."</h3>";
}else {
    View::navigation();

    View::welcome();
}

View::footer();

View::end();