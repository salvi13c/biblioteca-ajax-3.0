<?php
session_start();

//si no se ha iniciado sesion nos lleva al login
if(!isset($_SESSION['login'])){
    echo "no se ha iniciado sesion";
    header ("Location: login.php");
}else{
    //session_abort();
    
    //si hay una sesion iniciada se elimina la sesion y nos lleva de vuelta al login
    session_destroy();
    header ("Location: login.php");
}

?>