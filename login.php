<?php
    include_once 'presentation.class.php';
    include_once 'business.class.php';
    
    View::start('Clínica WebSalud', 0);
    
    User::session_start();
    
    echo "<img src='logo.png'>";
    
    View::navigation();
    
    if (count($_POST) > 0) {
        if (User::login($_POST['usuario'], $_POST['password'])){
            echo "<h1>Usuario logueado como: </h1>";
            
            if(isset($_SESSION['user'])){
                header("Location: ./index.php");
            }
        }else {
            echo "<h1> No se pudo hacer el login</h1>";
        }
    }
?>

    <form method="POST">
        <input type="text" name="usuario" id="usuario" placeholder="Usuario"/>
        <input type="password" name="password" id="password" placeholder="Contraseña"/>
        <input type="submit" value="Iniciar" />
    </form>

<?php
    
    View::footer();
    
    View::end();