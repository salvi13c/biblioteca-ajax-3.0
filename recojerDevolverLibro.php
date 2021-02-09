<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";
$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die("Fallo al conectarse a la base de datos: " . mysqli_connect_error()); //comprobamos si no hay conexión. Si no hay, identificamos el error y terminanos la ejecución del código.
}


$sql ="select * from Cogen_Prestado";
$resultado=mysqli_query($conexion, $sql);
$fila = $resultado->fetch_array();
if ($fila[2]=="reservado"){
    
    //actualiza los el estado del libro a prestado
    $sql="update Cogen_Prestado set EstadoLibro='prestado' where IdUser='". $_GET["user"]."' and IdLibro='". $_GET["idLibro"]."'";
    $resultado=mysqli_query($conexion, $sql);
}else if ($fila[2]=="prestado"){
    //en caso de que el libro esté prestado lo elimina
    $sql="delete from Cogen_Prestado where IdUser='". $_GET["user"]."' and IdLibro='". $_GET["idLibro"]."'";
    $resultado=mysqli_query($conexion, $sql);
    
    //selecciona todos los libros que corresponden a un id
    $sql="select * from Libros where Id='". $_GET["idLibro"]."'";
    $resultado=mysqli_query($conexion, $sql);
    $fila = $resultado->fetch_array();
    
    //Suma 1 a la cantidad de libros disponibles (por que se añade 1 libro devuelto)
    $cantidadLibrosDisponible=$fila[5]+1;
    $sql="update libros set Disponible='".$cantidadLibrosDisponible."' where Id='".$fila[7]."'";
    $resultado=mysqli_query($conexion, $sql);
    
    //resta 1 a la cantidad de libros reservados (por que se devuelve 1 libro)
    $cantidadLibrosReservado=$fila[6]-1;
    $sql="update libros set Reservado='".$cantidadLibrosReservado."' where Id='".$fila[7]."'";
    $resultado=mysqli_query($conexion, $sql);
}

if ($fila!=null){
    echo "El libro ya esta prestado";
}else{
    echo "libro prestado de forma correcta";
}

?>