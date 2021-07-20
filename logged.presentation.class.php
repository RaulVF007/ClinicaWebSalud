<?php
    include_once 'business.class.php';
    include_once 'logged.presentation.class.php';
    
    class LoggedView {
            public static function navigation($tipo, $loadUrl){
                echo '<nav>';    
                    echo '<ul class="menu">';
                        if($loadUrl == 0){
                            echo '<li class="item_menu"><a href="./index.php" class="active">Inicio</a></li>';
                        }elseif($loadUrl == 1){
                            echo '<li class="item_menu"><a href="../index.php" class="active">Inicio</a></li>';
                        }
                        
                        if($tipo == 1){ //Administrador
                            if($loadUrl == 0){
                                echo '<li class="item_menu"><a href="./administrador.php">Listar especialistas</a></li>';
                            }elseif($loadUrl == 1){
                                echo '<li class="item_menu"><a href="../administrador.php">Listar especialistas</a></li>';
                            }
                        }else if($tipo == 2){ //Especialista
                            if($loadUrl == 0){
                                echo '<li class="item_menu"><a href="./especialistas.php">Listado de pacientes asignados</a></li>';
                            }elseif($loadUrl == 1){
                                echo '<li class="item_menu"><a href="../especialistas.php">Listado de pacientes asignados</a></li>';
                            }
                        }else if($tipo == 3){ //Auxiliares
                            if($loadUrl == 0){
                                echo '<li class="item_menu"><a href="./auxiliares.php">Añadir prueba al historial</a></li>';
                            }elseif($loadUrl == 1){ 
                                echo '<li class="item_menu"><a href="../auxiliares.php">Añadir prueba al historial</a></li>';
                            }
                        }else if($tipo == 4){ //Pacientes
                            if($loadUrl == 0){
                                echo '<li class="item_menu"><a href="./paciente.php">Listar especialistas</a></li>';
                                echo '<li class="item_menu"><a href="Paciente/pacienteHistorial.php">Ver historial médico</a></li>';
                            }elseif($loadUrl == 1){
                                echo '<li class="item_menu"><a href="../paciente.php">Listar especialistas</a></li>';
                                echo '<li class="item_menu"><a href="../Paciente/pacienteHistorial.php">Ver historial médico</a></li>';
                                
                            }
                        }
                        
                        if($loadUrl == 0){
                            echo '<li class="btn-login"><a href="./logout.php">Cerrar sesión</a></li>';
                        }elseif($loadUrl == 1){
                            echo '<li class="btn-login"><a href="../logout.php">Cerrar sesión</a></li>';
                        }
                    echo '</ul>';
                echo '</nav>';
            }
    }
