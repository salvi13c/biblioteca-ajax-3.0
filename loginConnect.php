<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "biblioteca";
    $conexion = mysqli_connect($servername, $username, $password, $database);
    if (!$conexion) {
        die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
    }
    $sql="select contraseña from Usuarios where usuario='". $_GET["user"]."'"; //se selecciona la contraseña que corresponde a un determinado usuario.
    $resultado=mysqli_query($conexion, $sql);
    $fila = $resultado->fetch_array();



    if ($fila!=null){ //si la fila es nula el usuario no existe
        //verifica la contraseña (teniendo en cuenta que en la base de datos esta en formato hash)
        if (password_verify($_GET["pass"], $fila[0])){
            echo "Contraseña correcta";
            session_start(); //inicia la sesion
            $_SESSION["login"]=$_GET["user"];
        }else{
            echo 'Contraseña Incorrecta';
        }
    }else{
        echo 'el usuario no existe'; 
    }


?>