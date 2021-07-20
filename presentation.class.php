<?php
include_once 'business.class.php';
class View{
    public static function  start($title, $loadCss){
        $html = "<!DOCTYPE html>
        <html>
        <head>
        <meta charset=\"utf-8\">";
        
        if($loadCss == 0){
            $html = $html."<link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">";
        }elseif($loadCss == 1){
            $html = $html."<link rel=\"stylesheet\" type=\"text/css\" href=\"../estilos.css\">";
        }

        
        $html = $html."<script src=\"scripts.js\"></script>
        <title>$title</title>
        </head>
        <body>";
        User::session_start();
        echo $html;
    }

    public static function navigation(){
        echo '<nav>';    
            echo '<ul class="menu">';
                echo '<li class="item_menu"><a href="./index.php" class="active">Inicio</a></li>';
                echo '<li class="item_menu"><a href="./especialidades.php">Especialidades</a></li>';
                echo '<li class="item_menu"><a href="./contacto.php">Contacto</a></li>';
                echo '<li class="btn-login"><a href="./login.php">Iniciar sesión</a></li>';
            echo '</ul>';
        echo '</nav>';
    }
    
    public static function welcome(){
        echo '<img src="./slide3_png.jpg" alt="Imagen de los doctores">';
    
        echo '<h3>En nuestra clínica, encontrarás a los mejores profesionales en todas
        nuestras especialidades. Contamos con los equipos técnicos más avanzados
        y las mejores técnicas, contamos con los mejores equipos de médicos de la
        ciudad y todo al mejor precio. En Clínica WebSalud está en las mejores manos.</h3>';
    }
    
    public static function footer(){
        echo '<footer>
                 <p>Práctica HTML - CSS  P4 ULPGC</p>
             </footer>';
    }

    public static function end(){
        echo '</body>
</html>';
    }
}




/*<?php
include_once 'business.class.php';
class View{
    public static function  start($title){
        $html = "<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"estilos.css\">
<script src=\"scripts.js\"></script>
<title>$title</title>
</head>
<body>";
        User::session_start();
        echo $html;
    }

    public static function imgtobase64($img){
        $b64 = base64_encode($img);
        $signature = substr($b64, 0, 3);
        if ( $signature == '/9j') {
            $mime = 'data:image/jpeg;base64,';
        } else if ( $signature == 'iVB') {
            $mime = 'data:image/png;base64,';
        }
        return $mime . $b64;
    }

    public static function navigation(){
        echo '<nav>';
        echo '</nav>';
    }

    public static function end(){
        echo '</body>
</html>';
    }
}*/
