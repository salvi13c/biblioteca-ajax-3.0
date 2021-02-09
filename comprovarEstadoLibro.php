<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
}

$sql="select ID from Usuarios where usuario='". $_GET["user"]."'";
$resultado=mysqli_query($conexion, $sql);
$fila = $resultado->fetch_array();

if ($fila!=null){
    $IdUser=$fila[0]; //convierte el idUser del nombre al id de usuario
}else{
    echo "el usuario no existe";
}

$sql="select * from Cogen_Prestado where IdUser='". $IdUser."' and IdLibro='". $_GET["idLibro"]."'";
$resultado=mysqli_query($conexion, $sql);
$fila = $resultado->fetch_array();

//si el select sale null significa que no hay ninguna reserva del libro para un determinado usuario si no el libro esta reservado
if ($fila!=null){
    echo "El libro ya esta reservado";
}else{
    echo "Libro disponible para reserva";
}

?>